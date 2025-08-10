<?php

namespace App\Http\Controllers\Backend\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Category;
use App\Models\Backend\Product;
use App\Models\Backend\Brand;
use Auth;

class BrandController extends Controller
{
    
    public function listBrand()
    {
        $data['getRecord'] = Brand::getRecord();
        $data['header_title'] = "Brand";
        return view('backend.brand.list',$data);
    }


    public function addBrand()
    {
        $data['header_title'] = "Add New Brand";
        return view('backend.brand.add',$data);
    }


    public function insertBrand(Request $request) 
    {
        // dd($request->all());

        request()->validate([
            'slug' => 'required|unique:brands',
        ]);

        $brand = new Brand;
        $brand->name =  trim($request->name);
        $brand->slug = trim($request->slug);
        $brand->status = trim($request->status);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_description = trim($request->meta_description);
        $brand->meta_keywords = trim($request->meta_keywords);
        $brand->created_by = Auth::user()->id; 
        $brand->save();

        return redirect('brands/brand/list')->with('success',"Brand Successfully Created");
    }


    public function editBrand($id) 
    {
    
        $data['getRecord'] = Brand::getSingle($id);
        $data['header_title'] = "Edit Brand";
        return view('backend.brand.edit',$data);
    }



    public function updateBrand($id, Request $request) 
    {
        request()->validate([
            'slug' => 'required|unique:brands,slug,'.$id
        ]);

        $brand =  Brand::getSingle($id);
        $brand->name =  trim($request->name);
        $brand->slug = trim($request->slug);
        $brand->status = trim($request->status);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_description = trim($request->meta_description);
        $brand->meta_keywords = trim($request->meta_keywords);
        $brand->created_by = Auth::user()->id; 
        $brand->save();

        return redirect('brands/brand/list')->with('success',"Brand Successfully Updated");
    }
    

    public function deleteBrand($id) 
    {

        $brand = Brand::getSingle($id);
        $brand->is_delete = 1;
        $brand->save();

        return redirect()->back()->with('deleting',"Brand Successfully Deleted");
    }
}
