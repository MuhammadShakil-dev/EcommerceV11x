<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Payments\Order;
// use App\Models\Backend\ShippingCharge;
use App\Mail\OrderStatusMail;
use Mail;
use App\Models\Backend\Notification;



class OrderController extends Controller
{
    
    public function listOrder()
    {
        $data['getRecord'] = Order::getRecord();
        $data['header_title'] = "Order";
        return view('backend.order.list',$data);
    }


    public function detailOrder($id, Request $request)
    {
        if (!empty($request->notification_id))
        {
            Notification::updateReadNotification($request->notification_id);
        }
        $data['getRecord'] = Order::getSingle($id);
        $data['header_title'] = "Order Detail";
        return view('backend.order.detail',$data);
    }


    public function orderStatus(Request $request)
    {
        // dd($request->all());

        $getOrder = Order::getSingle($request->order_id);
        $getOrder->status = $request->status;
        $getOrder->save();

         // .....Notification.....
         $user_id = $getOrder->user_id;
         $url = url('user/order');
         $message = "Your Order Status Updated #".$getOrder->order_number;

         Notification::insertRecord($user_id, $url, $message);
         // ...../Notification.....



        Mail::to($getOrder->email)->send(new OrderStatusMail($getOrder));

        $json['message'] = "Status successfully updated";
        echo json_encode($json);
    }

     
}
