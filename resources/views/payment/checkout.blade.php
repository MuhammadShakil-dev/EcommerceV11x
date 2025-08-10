@extends('frontend.layouts.app')
@section('style')
<!-- some page style -->  

@endsection
@section('content')

<main class="main">
            <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
                <div class="container">
                    <h1 class="page-title">Checkout<span>Shop</span></h1>
                </div><!-- End .container -->
            </div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="checkout">
                    <div class="container">

                        <!-- <div class="checkout-discount">
                            <form action="#">
                                <input type="text" class="form-control" required id="checkout-discount-input">
                                <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                            </form>
                        </div> -->

                        <form action="" id="submitCheckoutForm" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-9">
                                    <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>First Name *</label>
                                                <input type="text" name="first_name" value="{{!empty(Auth::user()->name) ? Auth::user()->name : ''}}" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Last Name *</label>
                                                <input type="text" name="last_name" value="{{!empty(Auth::user()->last_name) ? Auth::user()->last_name : ''}}" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <label>Company Name (Optional)</label>
                                        <input type="text" name="company_name" value="{{!empty(Auth::user()->company_name) ? Auth::user()->company_name : ''}}" class="form-control">

                                        <label>Country *</label>
                                        <input type="text" name="country" value="{{!empty(Auth::user()->country) ? Auth::user()->country : ''}}" class="form-control" required>

                                        <label>Street address *</label>
                                        <input type="text"name="street_address_one" value="{{!empty(Auth::user()->street_address_one) ? Auth::user()->street_address_one : ''}}" class="form-control" placeholder="House number and Street name" required>
                                        <input type="text" name="street_address_two" value="{{!empty(Auth::user()->street_address_two) ? Auth::user()->street_address_two : ''}}" class="form-control" placeholder="Appartments, suite, unit etc ..." required>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Town / City *</label>
                                                <input type="text" name="city" value="{{!empty(Auth::user()->city) ? Auth::user()->city : ''}}" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>State *</label>
                                                <input type="text" name="state" value="{{!empty(Auth::user()->state) ? Auth::user()->state : ''}}" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Postcode / ZIP *</label>
                                                <input type="text" name="postcode" value="{{!empty(Auth::user()->postcode) ? Auth::user()->postcode : ''}}" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Phone *</label>
                                                <input type="tel" name="phone" value="{{!empty(Auth::user()->phone) ? Auth::user()->phone : ''}}" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <label>Email address *</label>
                                        <input type="email" name="email" value="{{!empty(Auth::user()->email) ? Auth::user()->email : ''}}" class="form-control" required>

                                         @if(empty(Auth::check()))

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="is_create" class="custom-control-input createAccount" id="checkout-create-acc">
                                            <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                                        </div><!-- End .custom-checkbox --> 

                                        <div id="showPassword" style="display: none;">
                                            <label>Password *</label>
                                            <input type="text" id="inputPassword" name="password" class="form-control">
                                        </div>

                                        @endif


                                        <!-- <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkout-diff-address">
                                            <label class="custom-control-label" for="checkout-diff-address">Ship to a different address?</label>
                                        </div> -->

                                        <label>Order notes (optional)</label>
                                        <textarea name="notes" class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                </div><!-- End .col-lg-9 -->
                                <aside class="col-lg-3">
                                    <div class="summary">
                                        <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                        <table class="table table-summary">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach(Cart::getContent() as $key => $cart)
                                                 @php
                                                  $getCartProduct = App\Models\Backend\Product::getSingle($cart->id);
                                                @endphp
                                                <tr>
                                                    <td><a href="{{ url($getCartProduct->slug) }}">{{$getCartProduct->title}}</a></td>
                                                    <td>${{ number_format($cart->price * $cart->quantity, 2) }}</td>
                                                </tr>
                                                @endforeach
                                                <tr class="summary-subtotal">
                                                    <td>Subtotal:</td>
                                                    <td>${{ number_format(Cart::getSubTotal(), 2) }}</td>
                                                </tr><!-- End .summary-subtotal -->
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="cart-discount">
                                                            <div class="input-group">
                                                            <input type="text" name="discount_code" id="getDiscountCode" class="form-control"  placeholder="Discount code">
                                                            <div class="input-group-append">
                                                            <button id="ApplyDiscount" style="height: 38px;" type="button" class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                                            </div>
                                                           </div>
                                                        </div> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Discount:</td>
                                                    <td>$ <span id="getDiscountAmount">0.00</span> </td>
                                                </tr><!-- End .summary-subtotal -->


                                                <!-- <tr>
                                                    <td>Shipping:</td>
                                                    <td>Free shipping</td> 
                                                </tr> -->

                                                <tr class="summary-shipping">
                                                  <td>Shipping:</td>
                                                  <td>&nbsp;</td>
                                                </tr>

                                                @foreach($shipping_charge as $shiping)
                                                 <tr class="summary-shipping-row">
                                                   <td>
                                                     <div class="custom-control custom-radio">
                                                        <input type="radio" value="{{$shiping->id}}" id="free-shipping {{$shiping->id}}" name="shipping" required data-price="{{ !empty($shiping->price) ? $shiping->price : 0 }}" class="custom-control-input getShippingCharge">
                                                        <label class="custom-control-label" for="free-shipping {{$shiping->id}}">{{$shiping->name}}</label>
                                                      </div>
                                                     </td>
                                                     <td>
                                                        @if(!empty($shiping->price))
                                                          ${{number_format($shiping->price,2)}}
                                                        @endif
                                                     </td>
                                                 </tr>
                                                @endforeach 


                                                <tr class="summary-total">
                                                    <td>Total:</td>
                                                    <td> <span id="getPayableTotal">${{ number_format(Cart::getSubTotal(), 2) }}</span> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" id="PayableTotal" value="{{Cart::getSubTotal()}}">
                                        <input type="hidden" id="getShippingChargeTotal" value="0">

                                        <div class="accordion-summary" id="accordion-payment">

                                            <!-- <div class="card">
                                                <div class="card-header" id="heading-1">
                                                    <h2 class="card-title">
                                                        <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                                            Direct bank transfer
                                                        </a>
                                                    </h2>
                                                </div>
                                                <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                                    </div>
                                                </div>
                                            </div> -->


                                            <!-- <div class="card">
                                                <div class="card-header" id="heading-2">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                                            Check payments
                                                        </a>
                                                    </h2>
                                                </div>
                                                <div id="collapse-2" class="collapse" aria-labelledby="heading-2" data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        Ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. 
                                                    </div>
                                                </div>
                                            </div> -->

                                              @if(!empty($getPaymentSetting->is_cash_delivery))
                                              <div class="custom-control custom-radio">
                                                   <input type="radio" id="cash-on-delivery" value="cash" name="payment_method" required  class="custom-control-input">
                                                   <label class="custom-control-label" for="cash-on-delivery">Cash on delivery</label>
                                              </div>
                                              @endif


                                              @if(!empty($getPaymentSetting->is_paypal))
                                              <div class="custom-control custom-radio" style="margin-top: 0px;">
                                                   <input type="radio" id="paypal" value="paypal" name="payment_method" required  class="custom-control-input">
                                                   <label class="custom-control-label" for="paypal">PayPal</label>
                                              </div>
                                              @endif


                                              @if(!empty($getPaymentSetting->is_stripe))
                                              <div class="custom-control custom-radio" style="margin-top: 0px;">
                                                   <input type="radio" id="stripe" value="stripe" name="payment_method" required  class="custom-control-input">
                                                   <label class="custom-control-label" for="stripe">Credit Card (Stripe)</label>
                                              </div>
                                              @endif



                                            <!-- <div class="card">
                                                <div class="card-header" id="heading-3">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                                            Cash on delivery
                                                        </a>
                                                    </h2>
                                                </div>
                                                <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordion-payment">
                                                    <div class="card-body">Quisque volutpat mattis eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. 
                                                    </div>
                                                </div>
                                            </div> -->


                                            <!-- <div class="card">
                                                <div class="card-header" id="heading-4">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                                            PayPal <small class="float-right paypal-link">What is PayPal?</small>
                                                        </a>
                                                    </h2>
                                                </div>
                                                <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum.
                                                    </div>
                                                </div>
                                            </div> -->



                                            <!-- <div class="card">
                                                <div class="card-header" id="heading-5">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                                            Credit Card (Stripe)
                                                            <img src="public/frontend/assets/images/payments-summary.png" alt="payments cards">
                                                        </a>
                                                    </h2>
                                                </div>
                                                <div id="collapse-5" class="collapse" aria-labelledby="heading-5" data-parent="#accordion-payment">
                                                    <div class="card-body"> Donec nec justo eget felis facilisis fermentum.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Lorem ipsum dolor sit ame.
                                                    </div>
                                                </div>
                                            </div> -->


                                        </div><!-- End .accordion -->

                                        <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                            <span class="btn-text">Place Order</span>
                                            <span class="btn-hover-text">Proceed to Checkout</span>
                                        </button>
                                        <br>
                                        <br>
                                        <img src="{{url('public/frontend/assets/images/payments-summary.png')}}" alt="payments cards">

                                    </div><!-- End .summary -->
                                </aside><!-- End .col-lg-3 -->
                            </div><!-- End .row -->
                        </form>
                    </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

@endsection

@section('script')
<!-- some page script --> 
<script type="text/javascript"> 

   // Discount Code
   $('body').delegate('#ApplyDiscount', 'click', function() {
      var discountCode = $('#getDiscountCode').val();

         $.ajax({
            type : "POST",
            url : "{{ url('checkout/apply_discount_code') }}",
            data : {
                discountCode: discountCode,
                "_token": "{{ csrf_token() }}",
            },
            dataType : "json",
            success: function (data) 
            {
                $('#getDiscountAmount').html(data.discount_amount);
                var shipping = $('#getShippingChargeTotal').val();
                var final_total = parseFloat(shipping) + parseFloat(data.payable_total);


                $('#getPayableTotal').html(final_total.toFixed(2));
                $('#PayableTotal').val(data.payable_total);
                if (data.status == false) 
                {
                    alert(data.message);
                }
            },
            error: function (data) 
            {
                // body...
            }
        });
    });

   // Get Shipping Charge
   $('body').delegate('.getShippingCharge', 'change', function() {
            var price = $(this).attr('data-price');
            // console.log(price);
            var total = $('#PayableTotal').val();
            $('#getShippingChargeTotal').val(price);
            var final_total = parseFloat(price) + parseFloat(total);
            $('#getPayableTotal').html(final_total.toFixed(2));

   });


   

   // Create Account
   $('body').delegate('.createAccount', 'change', function() {

      if(this.checked) 
      {
        $('#showPassword').show();
        $('#inputPassword').prop('required',true);
      }
      else
      {
        $('#showPassword').hide();
        $('#inputPassword').prop('required',false);

      }
   });


   // Submit Checkout Form.
   $('body').delegate('#submitCheckoutForm', 'submit', function(e) {
       e.preventDefault();
       $.ajax({
            type : "POST",
            url : "{{ url('checkout/place_order') }}",
            data : new FormData(this),
            processData:false,
            contentType:false,
            dataType : "json",
            success: function (data) 
            {
                if (data.status == false) 
                {
                    alert(data.message);
                }
                else
                {
                    window.location.href = data.redirect;
                }
            },
            error: function (data) 
            {
                // body...
            }
        });
   });

</script>

@endsection           