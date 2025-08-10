<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Backend\Category;
use App\Models\Backend\SubCategory;

class SubCategoryController extends Controller
{
    public function listsubCategory()
    {
        $data['getRecord'] = SubCategory::getRecord();
        $data['header_title'] = "Sub Category";
        return view('backend.subCategory.list',$data);
    }

    public function addsubCategory()
    {
        $data['getCategory'] = Category::getRecord();
        $data['header_title'] = "Add New sub Category";
        return view('backend.subCategory.add',$data);
    }


    public function insertSubCategory(Request $request) 
    {
        // dd($request->all());

        request()->validate([
            'slug' => 'required|unique:sub_categories',
        ]);

        $subCategory = new SubCategory;
        $subCategory->category_id =  trim($request->category_id);
        $subCategory->name =  trim($request->name);
        $subCategory->slug = trim($request->slug);
        $subCategory->status = trim($request->status);
        $subCategory->meta_title = trim($request->meta_title);
        $subCategory->meta_description = trim($request->meta_description);
        $subCategory->meta_keywords = trim($request->meta_keywords);
        $subCategory->created_by = Auth::user()->id; 
        $subCategory->save();

        return redirect('subCategories/subCategory/list')->with('success',"Sub Category Successfully Created");
    }

    public function editsubCategory($id) 
    {
        
        $data['getCategory'] = Category::getRecord();
        $data['getRecord'] = SubCategory::getSingle($id);
        $data['header_title'] = "Edit Category";
        return view('backend.subCategory.edit',$data);
    }



    public function updatesubCategory($id, Request $request) 
    {
        
        request()->validate([
            'slug' => 'required|unique:sub_categories,slug,'.$id
        ]);

        $subCategory =  SubCategory::getSingle($id);
        $subCategory->category_id =  trim($request->category_id);
        $subCategory->name =  trim($request->name);
        $subCategory->slug = trim($request->slug);
        $subCategory->status = trim($request->status);
        $subCategory->meta_title = trim($request->meta_title);
        $subCategory->meta_description = trim($request->meta_description);
        $subCategory->meta_keywords = trim($request->meta_keywords);
        $subCategory->save();

        return redirect('subCategories/subCategory/list')->with('success',"Sub Category Successfully Updated");
    }

    public function deletesubCategory($id) 
    {

        $user = SubCategory::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect()->back()->with('deleting',"Sub Category Successfully Deleted");
    }


    public function getSubCategories(Request $request) 
    {
        
        // dd($request->all());

        $category_id = $request->id;
        $getSubCategory =  SubCategory::getRecordSubCategory($category_id);
        $html = '';
        $html .= '<option value="">Select</option>';
        foreach ($getSubCategory as $value) 
        {
            $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';

        }
        $json['html'] = $html;
        echo json_encode($json);

    }
}
