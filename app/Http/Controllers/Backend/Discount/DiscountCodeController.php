<?php

namespace App\Http\Controllers\Backend\Discount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\DiscountCode;
use Auth;

class DiscountCodeController extends Controller
{
    
    public function listDiscountCode()
    {
        $data['getRecord'] = DiscountCode::getRecord();
        $data['header_title'] = "Discount code";
        return view('backend.discountCode.list',$data);
    }


    public function addDiscountCode()
    {
        $data['header_title'] = "Add New Discount Code";
        return view('backend.discountCode.add',$data);
    }


    public function insertDiscountCode(Request $request) 
    {

        $DiscountCode = new DiscountCode;
        $DiscountCode->name =  trim($request->name);
        $DiscountCode->type = trim($request->type);
        $DiscountCode->percent_amount = trim($request->percent_amount);
        $DiscountCode->expire_date = trim($request->expire_date);
        $DiscountCode->status = trim($request->status);
        $DiscountCode->save();

        return redirect('discountCodes/discountCode/list')->with('success',"Discount Code Successfully Created");
    }


    public function editDiscountCode($id) 
    {
    
        $data['getRecord'] = DiscountCode::getSingle($id);
        $data['header_title'] = "Edit Discount Code";
        return view('backend.discountCode.edit',$data);
    }



    public function updateDiscountCode($id, Request $request) 
    {
        
        $DiscountCode =  DiscountCode::getSingle($id);
        $DiscountCode->name =  trim($request->name);
        $DiscountCode->type = trim($request->type);
        $DiscountCode->percent_amount = trim($request->percent_amount);
        $DiscountCode->expire_date = trim($request->expire_date);
        $DiscountCode->status = trim($request->status);
        $DiscountCode->save();

        return redirect('discountCodes/discountCode/list')->with('success',"Discount Code Successfully Updated");
    }
    

    public function deleteDiscountCode($id) 
    {

        $color = DiscountCode::getSingle($id);
        $color->is_delete = 1;
        $color->save();

        return redirect()->back()->with('deleting',"Discount Code Successfully Deleted");
    }

    
}
