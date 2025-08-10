<?php

namespace App\Http\Controllers\Backend\Shipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\ShippingCharge;
use Auth;

class ShippingChargeController extends Controller
{

    public function listShippingCharge()
    {
        $data['getRecord'] = ShippingCharge::getRecord();
        $data['header_title'] = "Shipping Charge";
        return view('backend.shippingCharge.list',$data);
    }


    public function addShippingCharge()
    {
        $data['header_title'] = "Add New Shipping Charge";
        return view('backend.shippingCharge.add',$data);
    }


    public function insertShippingCharge(Request $request) 
    {

        $shippingCharge = new ShippingCharge;
        $shippingCharge->name =  trim($request->name);
        $shippingCharge->price = trim($request->price);
        $shippingCharge->status = trim($request->status);
        $shippingCharge->save();

        return redirect('shipping_charges/shipping_charge/list')->with('success',"Shipping Charge Successfully Created");
    }


    public function editShippingCharge($id) 
    {
    
        $data['getRecord'] = ShippingCharge::getSingle($id);
        $data['header_title'] = "Edit Shipping Charge";
        return view('backend.shippingCharge.edit',$data);
    }



    public function updateShippingCharge($id, Request $request) 
    {
        
        $shippingCharge =  ShippingCharge::getSingle($id);
        $shippingCharge->name =  trim($request->name);
        $shippingCharge->price = trim($request->price);
        $shippingCharge->status = trim($request->status);
        $shippingCharge->save();

        return redirect('shipping_charges/shipping_charge/list')->with('success',"Shipping Charge Successfully Updated");
    }
    

    public function deleteShippingCharge($id) 
    {

        $shippingCharge = ShippingCharge::getSingle($id);
        $shippingCharge->is_delete = 1;
        $shippingCharge->save();

        return redirect()->back()->with('deleting',"Shipping Charge Successfully Deleted");
    }


}
