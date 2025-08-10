<?php

namespace App\Http\Controllers\Backend\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Partner;
use Auth;
use Str;

class PartnerController extends Controller
{

     public function partnerList()
    {
        $data['getRecord'] = Partner::getRecord();
        $data['header_title'] = "Partner";
        return view('backend.partner.list',$data);
    }


    public function partnerAdd()
    {
        $data['header_title'] = "Add New Partner";
        return view('backend.partner.add',$data);
    }


    public function partnerInsert(Request $request) 
    {

        $partner = new Partner;
        $partner->button_link = trim($request->button_link);
        
        $file = $request->file('image_name');
        $ext = $file->getClientOriginalExtension();
        $randomStr = Str::random(20);
        $filename = strtolower($randomStr).'.'.$ext;
        $file->move('public/upload/partner/', $filename);

        $partner->image_name = trim($filename);
        $partner->status = trim($request->status);
        $partner->save();

        return redirect('partners/partner/list')->with('success',"Partner Successfully Created");
    }


    public function PartnerEdit($id) 
    {
    
        $data['getRecord'] = Partner::getSingle($id);
        $data['header_title'] = "Edit Partner";
        return view('backend.partner.edit',$data);
    }



    public function partnerUpdate($id, Request $request) 
    {
        
        $partner =  Partner::getSingle($id);

        $partner->button_link = trim($request->button_link);

        if (!empty($request->file('image_name')))
        {
            // code...
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
           $file->move('public/upload/partner/', $filename);

           $partner->image_name = trim($filename);
        }
        
        $partner->status = trim($request->status);
        $partner->save();

        return redirect('partners/partner/list')->with('success',"Partner Successfully Updated");
    }
    

    public function PartnerDelete($id) 
    {

        $partner = Partner::getSingle($id);
        $partner->is_delete = 1;
        $partner->save();

        return redirect()->back()->with('deleting',"Partner Successfully Deleted");
    }
}
