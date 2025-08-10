<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\SystemSetting;
use App\Models\Backend\HomeSetting;
use App\Models\Backend\Notification;
use App\Models\Backend\SMTP;
use App\Models\Backend\PaymentSetting;
use Str;


class HomeSettingController extends Controller
{

    public function homeSetting() 
    {
        $data['header_title'] = "Home Setting";
        $data['getRecord'] = HomeSetting::getSingle();

        return view('backend.setting.home_setting',$data);
    }


    public function updatehomeSetting(Request $request) 
    {
        // dd($request->all());

        $save =  HomeSetting::getSingle();
        $save->trendy_product_title =  trim($request->trendy_product_title);
        $save->shop_category_title = trim($request->shop_category_title);
        $save->recenta_arrival_title = trim($request->recenta_arrival_title);
        $save->blog_title = trim($request->blog_title);

        $save->payment_delivery_title = trim($request->payment_delivery_title);
        $save->payment_delivery_description = trim($request->payment_delivery_description);
        // image
        if (!empty($request->file('payment_delivery_image')))
        {
          $file = $request->file('payment_delivery_image');
          $ext = $file->getClientOriginalExtension();
          $randomStr = Str::random(10);
          $filename = strtolower($randomStr).'.'.$ext;
          $file->move('public/upload/setting/homeSetting/', $filename);

          $save->payment_delivery_image = trim($filename);
          $save->save();           
        }

        $save->refund_title = trim($request->refund_title);
        $save->refund_description = trim($request->refund_description);
        // image
        if (!empty($request->file('refund_image')))
        {
          $file = $request->file('refund_image');
          $ext = $file->getClientOriginalExtension();
          $randomStr = Str::random(10);
          $filename = strtolower($randomStr).'.'.$ext;
          $file->move('public/upload/setting/homeSetting/', $filename);

          $save->refund_image = trim($filename);
          $save->save();           
        }

        $save->support_title = trim($request->support_title);
        $save->support_description = trim($request->support_description);
        // image
        if (!empty($request->file('support_image')))
        {
          $file = $request->file('support_image');
          $ext = $file->getClientOriginalExtension();
          $randomStr = Str::random(10);
          $filename = strtolower($randomStr).'.'.$ext;
          $file->move('public/upload/setting/homeSetting/', $filename);

          $save->support_image = trim($filename);
          $save->save();           
        }

        $save->signup_title = trim($request->signup_title);
        $save->signup_description = trim($request->signup_description);
        // image
        if (!empty($request->file('signup_image')))
        {
          $file = $request->file('signup_image');
          $ext = $file->getClientOriginalExtension();
          $randomStr = Str::random(10);
          $filename = strtolower($randomStr).'.'.$ext;
          $file->move('public/upload/setting/homeSetting/', $filename);

          $save->signup_image = trim($filename);
          $save->save();           
        }

        $save->save();


        return redirect()->back()->with('success',"Home Setting Successfully Updated");

    }  


    
    public function notification() 
    {
        $data['header_title'] = "Notification";
        $data['getRecord'] = Notification::getRecord();

        return view('backend.notification.list',$data);
    }


    public function smtpSetting() 
    {
        $data['header_title'] = "SMTP Setting";
        $data['getRecord'] = SMTP::getSingle();

        return view('backend.setting.smtp_setting',$data);
    }


    public function updateSMPTsetting(Request $request) 
    {

        $save =  SMTP::getSingle();
        $save->name =  trim($request->name);
        $save->mail_mailer = trim($request->mail_mailer);
        $save->mail_host = trim($request->mail_host);
        $save->mail_port = trim($request->mail_port);
        $save->mail_user_name = trim($request->mail_user_name);
        $save->mail_password = trim($request->mail_password);
        $save->mail_encryption = trim($request->mail_encryption);
        $save->mail_form_address = trim($request->mail_form_address);
        $save->save();


        return redirect()->back()->with('success',"SMTP Setting Successfully Updated");

    }


    public function paymentSetting() 
    {
        $data['header_title'] = "Payment Setting";
        $data['getRecord'] = PaymentSetting::getSingle();

        return view('backend.setting.payment_setting',$data);
    }


    public function updatePaymentSetting(Request $request) 
    {

        $save =  PaymentSetting::getSingle();
        $save->paypal_id =  trim($request->paypal_id);
        $save->paypal_status = trim($request->paypal_status);
        $save->stripe_public_key = trim($request->stripe_public_key);
        $save->stripe_secret_key = trim($request->stripe_secret_key);
        $save->is_cash_delivery = !empty($request->is_cash_delivery) ? 1 : 0;
        $save->is_paypal = !empty($request->is_paypal) ? 1 : 0;
        $save->is_stripe = !empty($request->is_stripe) ? 1 : 0;
        $save->save();


        return redirect()->back()->with('success',"Payment Setting Successfully Updated");

    }



}
