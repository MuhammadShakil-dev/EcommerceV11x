<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\Backend\ProductSize;
use App\Models\Backend\DiscountCode;
use App\Models\Backend\ShippingCharge;
use App\Models\Backend\Notification;
use Cart;
use App\Models\Payments\Order;
use App\Models\Payments\OrderItem;
use App\Models\Backend\Color;
use App\Models\Backend\PaymentSetting;
use Auth;
use Hash;
use Str;
use App\Models\User;
use Stripe\Stripe;
use Session;
use App\Mail\OrderInvoiceMail;
use Mail;




class PaymentController extends Controller
{

    public function cart(Request $request)
    {
        // dd(Cart::getContent());
        $data['meta_title'] = 'Cart';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('payment.cart',$data);
    }

    public function checkOut(Request $request)
    {
        // dd(Cart::getContent());
        $data['meta_title'] = 'checkout';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['shipping_charge'] = ShippingCharge::getRecordActive();
        $data['getPaymentSetting'] = PaymentSetting::getSingle();

        return view('payment.checkout',$data);
    }


    public function deleteCart($id)
    {
        Cart::remove($id);

        return redirect()->back();
    }



    public function addToCart(Request $request)
    {
        $getProduct = Product::getSingle($request->product_id);
        $total = $getProduct->price;
        if (!empty($request->size_id)) 
        {
            $size_id = $request->size_id;
            $getsize = ProductSize::getSingle($size_id);

            $sizePrice = !empty($getsize->price) ? $getsize->price : 0;
            $total = $total + $sizePrice;

        }
        else
        {
            $size_id = 0;
        }
         
        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        Cart::add([
            'id' => $getProduct->id,
            // 'name' => 'static_name',
            'name' => 'Product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => array(
                'size_id' => $size_id,
                'color_id' => $color_id, 
            )
        ]);
        
        return redirect()->back()->with('success',"Iteam Successfully added into Cart");
    }



     
    public function updateCart(Request $request)
    {
        // dd($request->all());
        foreach ($request->cart as $cart) 
        {
            Cart::update($cart['id'], array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $cart['qty']
                ),
            ));
        }

        return redirect()->back();
    }


    public function applyDiscountCode(Request $request)
    {
        // dd($request->all());
        $getDiscount = DiscountCode::CheckDiscount($request->discountCode);

        if (!empty($getDiscount)) 
        {
            $total= Cart::getSubTotal();
            if ($getDiscount->type == 'Amount') 
            {
                $discount_amount = $getDiscount->percent_amount;
                $payable_total = $total - $getDiscount->percent_amount;
            }
            else
            {
                $discount_amount = ($total * $getDiscount->percent_amount) / 100;
                $payable_total = $total - $discount_amount;

            }

            $json['status'] = true;
            $json['discount_amount'] = number_format($discount_amount, 2);
            // $json['payable_total'] = number_format($payable_total, 2);
            $json['payable_total'] = $payable_total;
            $json['message'] = "success";
        }
        else
        {
            $json['status'] = false;
            $json['discount_amount'] = '0.00';
            // $json['payable_total'] = number_format(Cart::getSubTotal(), 2);
            $json['payable_total'] = Cart::getSubTotal();
            $json['message'] = "Discount Code Invalid";
        }

        echo json_encode($json);
    }


    
    public function placeOrder(Request $request)
    {
        // dd($request->all());

        $validate = 0;
        $message = '';
        if(!empty(Auth::check()))
        {
            $user_id = Auth::user()->id;
        }
        else
        {
            if(!empty($request->is_create))
            {

               $checkEmail = User::checkEmail($request->email);
               if (!empty($checkEmail)) 
               {
                  $message = "This email is already register please try another";
                  $validate = 1;
                }
                else
                {
                  $save = new User;
                  $save->name = trim($request->first_name);
                  $save->email = trim($request->email);
                  $save->password = Hash::make($request->password);
                  $save->save();

                  $user_id = $save->id;
                }

            } 
            else
            {
              $user_id = '';
            }
        }


        if (empty($validate)) 
        {
            $getShipping = ShippingCharge::getSingle($request->shipping);
            $payable_total = Cart::getSubTotal();
            $discount_amount = 0; 
            $discount_code = ''; 

         if(!empty($request->discount_code)) 
          {
             $getDiscount = DiscountCode::CheckDiscount($request->discount_code);
              if(!empty($getDiscount))
               {
                  $discount_code = $request->discount_code; 

                   if ($getDiscount->type == 'Amount') 
                   {
                     $discount_amount = $getDiscount->percent_amount;
                     $payable_total = $payable_total - $getDiscount->percent_amount;
                    }
                    else
                    {
                      $discount_amount = ($payable_total * $getDiscount->percent_amount) / 100;
                      $payable_total = $payable_total - $discount_amount;
                    }
                }
            }

             // dd($payable_total);

           $shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
           $total_amount = $payable_total + $shipping_amount;

           $order = new order;
           if (!empty($user_id))
           {
               $order->user_id = trim($user_id);

           }
           $order->order_number = mt_rand(100000000,999999999);
           $order->first_name = trim($request->first_name);
           $order->last_name = trim($request->last_name);
           $order->company_name = trim($request->company_name);
           $order->country = trim($request->country);
           $order->street_address_one = trim($request->street_address_one);
           $order->street_address_two = trim($request->street_address_two);
           $order->city = trim($request->city);
           $order->state = trim($request->state);
           $order->postcode = trim($request->postcode);
           $order->phone = trim($request->phone);
           $order->email = trim($request->email);
           $order->notes = trim($request->notes);
           $order->discount_amount = trim($discount_amount);
           $order->discount_code = trim($request->discount_code);
           $order->shipping_id = trim($request->shipping);
           $order->shipping_amount = trim($shipping_amount);
           $order->total_amount = trim($total_amount);
           $order->payment_method = trim($request->payment_method);
           $order->save();


          foreach(Cart::getContent() as $key => $cart)
          {
            // dd($cart);       

             $order_item = new OrderItem;
             $order_item->order_id = $order->id;
             $order_item->product_id = $cart->id;
             $order_item->quantity = $cart->quantity;
             $order_item->price = $cart->price;

             $color_id = $cart->attributes->color_id;
             if (!empty($color_id)) 
             {
               $getColor = Color::getSingle($color_id);
               $order_item->color_name = $getColor->name;
             }

             $size_id = $cart->attributes->size_id;
             if (!empty($size_id)) 
             {
               $getsize = ProductSize::getSingle($size_id);
               $order_item->size_name = $getsize->name;
               $order_item->size_amount = $getsize->price;
             }

             // $order_item->total_price = $cart->price;
             $order_item->total_price = $cart->price * $cart->quantity;
             $order_item->save();

          }
            $json['status'] = true;
            $json['message'] = "Order success";
            $json['redirect'] = url('checkout/payment?order_id='.base64_encode($order->id));
        }
        else
        {
            $json['status'] = false;
            $json['message'] = $message;
        }

         echo json_encode($json);

    }

    

    public function checkoutPayment(Request $request)
    {
        if(!empty(Cart::getSubTotal()) && !empty($request->order_id)) 
        {
            $order_id = base64_decode($request->order_id);
            $getOrder = Order::getSingle($order_id);
            if(!empty($getOrder))
            {
               $getPaymentSetting = PaymentSetting::getSingle();

                if($getOrder->payment_method == 'cash')
                {
                    $getOrder->is_payment = 1;
                    $getOrder->save();

                    try 
                    {
                        Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
                    }
                    catch (\Exception $e)
                    {
                        //
                    }
                    // Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));

                     // .....Notification.....
                     // $user_id = $getOrder->user_id; 
                     $user_id = 1; // 1 = admin
                     $url = url('orders/order/detail/'.$getOrder->id);
                     $message = "New Order placed #".$getOrder->order_number;

                     Notification::insertRecord($user_id, $url, $message);
                     // ...../Notification.....

                    Cart::clear();

                    return redirect('cart')->with('success', "Order successfully placed.");

                }
                else if($getOrder->payment_method == 'paypal')
                {
                    
                    $amount = $getOrder->total_amount;

                    // $getSetting = SettingModel::getSingle(); // just exm
                    // $paypalId = $getSettind->paypal_email;

                    // $paypalId =  "ShakeelKhan5534@gmail.com";  // PayPal Id
                    // $paypalId =  "sb-v1epo37680895@business.example.com";  // PayPal dumy sandbox Id
                    $paypalId =  $getPaymentSetting->paypal_id;  // id get form DB
                    $query                   = array();
                    $query['business']       = $paypalId;
                    $query['cmd']            = '_xclick';
                    $query['item_name']      = "E-commerce";
                    $query['no_shipping']    = 1;
                    $query['item_number']    = $getOrder->id;
                    $query['amount']         = $amount;
                    $query['currency_code']  = 'USD';
                    $query['cancel_return']  = url('checkout');
                    $query['return']         = url('paypal/success-payment');

                    $query_string = http_build_query($query);

                    // // Condition for live or sanndbox
                    if ($getPaymentSetting->paypal_status == 'live')
                    {
                        header('Location: https://www.paypal.com/cgi-bin/webscr?' .$query_string);
                    }
                    else
                    {
                        header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' .$query_string);

                    }

                    // // for with out Condition live or sanndbox
                    // header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' .$query_string)
                    // header('Location: https://sandbox.paypal.com' .$query_string);

                    //     header('Location: https://www.paypal.com/cgi-bin/webscr?' .$query_string);

                    exit();


                }
                else if($getOrder->payment_method == 'stripe')
                {
                    // Stripe::setApiKey(env('STRIPE_SECRET'));
                    Stripe::setApiKey($getPaymentSetting->stripe_secret_key); // get STRIPE_SECRET from DB
                    $finalprice = $getOrder->total_amount * 100;


                    $session = \Stripe\Checkout\Session::create([
                        'customer_email' => $getOrder->email,
                        'payment_method_types' => ['card'],
                        'line_items' => [[
                            'price_data' => [
                                'currency' => 'usd',
                                'product_data' => [
                                    'name' => 'E-commerce',
                                ],
                                'unit_amount' => intval($finalprice),
                            ],
                            'quantity' => 1,
                        ]],
                        'mode' => 'payment',
                        'success_url' => url('stripe/success-payment'),
                        'cancel_url'  => url('checkout'),
                    ]);
                    // dd($session);
                    
                    $getOrder->stripe_session_id = $session['id'];
                    $getOrder->save();

                    $data['session_id']  = $session['id'];
                    Session::put('stripe_session_id', $session['id']);
                    // $data['setPublicKey']  = $this->setPublicKey;
                    // $data['setPublicKey']  =  env('STRIPE_KEY');
                    $data['setPublicKey']  =  $getPaymentSetting->stripe_public_key; // get setPublicKey from DB

                    return view('payment.stripe_charge', $data);
                }
            }
            else
            {
                abort(404);
            }
        }
        else
        {
            abort(404);
        }
    }



    public function paypalSuccessPayment(Request $request)
    {
        // dd($request->all());

        if (!empty($request->item_number) &&  !empty($request->st) && $request->st == 'Completed' ) // item_number, st paypal data 
        {
            $getOrder = Order::getSingle($request->item_number);
            if(!empty($getOrder))
            {
                $getOrder->is_payment = 1;
                $getOrder->transaction_id = $request->tx;
                $getOrder->payment_data = json_encode($request->all());
                $getOrder->save();


                try 
                {
                    Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
                }
                catch (\Exception $e)
                {
                    //
                }

                // die;

                 // .....Notification.....
                 // $user_id = $getOrder->user_id;
                 $user_id = 1; // 1 = admin
                 $url = url('orders/order/detail/'.$getOrder->id);
                 $message = "New Order placed #".$getOrder->order_number;

                 Notification::insertRecord($user_id, $url, $message);
                 // ...../Notification.....

                Cart::clear();

                return redirect('cart')->with('success', "Order successfully placed.");
            } 
            else
            {
                abort(404);
            }  

        }
        else
        {
            abort(404);
        }
    }  

    
    public function stripeSuccessPayment(Request $request)
    {
        // dd($request->all());
        $getPaymentSetting = PaymentSetting::getSingle();

        $transactionId =  Session::get('stripe_session_id');
        // \Stripe\Stripe::setApiKey($this->setApiKey);
        // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Stripe::setApiKey($getPaymentSetting->stripe_secret_key); // get STRIPE_SECRET from DB
        $getdata = \Stripe\checkout\Session::retrieve($transactionId);
        // dd($getdata);

        $getOrder = Order::where('stripe_session_id', '=', $getdata->id)->first();


        if(!empty($getOrder) && !empty($getdata->id) && $getdata->id == $getOrder->stripe_session_id)
        {
            $getOrder->is_payment = 1;
            $getOrder->transaction_id = $getdata->id;
            $getOrder->payment_data = json_encode($getdata);
            $getOrder->save();


            try 
            {
                Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
            }
            catch (\Exception $e)
            {
                //
            }

             // .....Notification.....
             // $user_id = $getOrder->user_id; 
             $user_id = 1; // 1 = admin
             $url = url('orders/order/detail/'.$getOrder->id);
             $message = "New Order placed #".$getOrder->order_number;

             Notification::insertRecord($user_id, $url, $message);
             // ...../Notification.....


            Cart::clear();

            return redirect('cart')->with('success', "Order successfully placed.");
        }
        else
        {
            return redirect('cart')->with('error', "Due to some error please try again.");
        }

    }
    
}
