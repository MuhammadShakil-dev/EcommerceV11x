<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Category;
use Auth;
use Hash;
use Str;


class CategoryController extends Controller
{
    
    public function listCategory()
    {
        $data['getRecord'] = Category::getRecord();
        $data['header_title'] = "Category";
        return view('backend.category.list',$data);
    }

     public function addCategory()
    {
        $data['header_title'] = "Add New Category";
        return view('backend.category.add',$data);
    }

    public function insertCategory(Request $request) 
    {
        // dd($request->all());

        request()->validate([
            'slug' => 'required|unique:categories',
        ]);

        $category = new Category;
        $category->name =  trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);

        if (!empty($request->file('image_name')))
        {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
           $file->move('public/upload/category/', $filename);

           $category->image_name = trim($filename);
        }

        $category->button_name = trim($request->button_name);
        $category->is_home = !empty($request->is_home) ? 1 : 0;
        $category->is_menu = !empty($request->is_menu) ? 1 : 0;

        $category->created_by = Auth::user()->id; 
        $category->save();

        return redirect('categories/category/list')->with('success',"Category Successfully Created");
    }


    public function editCategory($id) 
    {
    
        $data['getRecord'] = Category::getSingle($id);
        $data['header_title'] = "Edit Category";
        return view('backend.category.edit',$data);
    }



    public function updateCategory($id, Request $request) 
    {
        request()->validate([
            'slug' => 'required|unique:categories,slug,'.$id 
        ]);

        $category =  Category::getSingle($id);
        $category->name =  trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);

        if (!empty($request->file('image_name')))
        {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
           $file->move('public/upload/category/', $filename);

           $category->image_name = trim($filename);
        }

        $category->button_name = trim($request->button_name);
        $category->is_home = !empty($request->is_home) ? 1 : 0;
        $category->is_menu = !empty($request->is_menu) ? 1 : 0;

        $category->created_by = Auth::user()->id; 
        $category->save();

        return redirect('categories/category/list')->with('success',"Category Successfully Updated");
    }

    public function deleteCategory($id) 
    {

        $user = Category::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect()->back()->with('deleting',"Category Successfully Deleted");
    }
}
