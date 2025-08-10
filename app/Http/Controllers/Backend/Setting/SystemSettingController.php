<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\SystemSetting;
use Str;


class SystemSettingController extends Controller
{

    public function systemSetting() 
    {
        $data['header_title'] = "System Setting";
        $data['getRecord'] = SystemSetting::getSingle();

        return view('backend.setting.system_setting',$data);
    }


    public function updateSystemSetting(Request $request) 
    {
        // dd($request->all());

        $save =  SystemSetting::getSingle();
        $save->website_name =  trim($request->website_name);
        $save->footer_description = trim($request->footer_description);
        $save->address = trim($request->address);
        $save->phone = trim($request->phone);
        $save->mobile = trim($request->mobile);
        $save->email = trim($request->email);
        $save->office_email = trim($request->office_email);
        $save->submit_contact_email = trim($request->submit_contact_email);
        $save->working_hour = trim($request->working_hour);
        $save->facebook_link = trim($request->facebook_link);
        $save->twitter_link = trim($request->twitter_link);
        $save->instagram_link = trim($request->instagram_link);
        $save->youtube_link = trim($request->youtube_link);
        $save->pinterest_link = trim($request->pinterest_link);

        // images
        if (!empty($request->file('logo')))
        {
          $file = $request->file('logo');
          $ext = $file->getClientOriginalExtension();
          $randomStr = Str::random(10);
          $filename = strtolower($randomStr).'.'.$ext;
          $file->move('public/upload/setting/', $filename);

          $save->logo = trim($filename);
          $save->save();           
        }


        if (!empty($request->file('fevicon')))
        {
          $file = $request->file('fevicon');
          $ext = $file->getClientOriginalExtension();
          $randomStr = Str::random(10);
          $filename = strtolower($randomStr).'.'.$ext;
          $file->move('public/upload/setting/', $filename);

          $save->fevicon = trim($filename);
          $save->save();           
        }

        if (!empty($request->file('footer_payment_icon')))
        {
          $file = $request->file('footer_payment_icon');
          $ext = $file->getClientOriginalExtension();
          $randomStr = Str::random(10);
          $filename = strtolower($randomStr).'.'.$ext;
          $file->move('public/upload/setting/', $filename);

          $save->footer_payment_icon = trim($filename);
          $save->save();           
        }

        $save->save();


        return redirect()->back()->with('success',"Setting Successfully Updated");


    }  


}
