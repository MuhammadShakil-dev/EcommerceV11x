<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\BlogCategory;
use Auth;
use Hash;
use Str;

class BlogCategoryController extends Controller
{

    public function listBlogCategoy()
    {
        $data['getRecord'] = BlogCategory::getRecord();
        $data['header_title'] = "Blog Category";
        return view('backend.blogCategoy.list',$data);
    }

     public function addBlogCategoy()
    {
        $data['header_title'] = "Add New Blog Category";
        return view('backend.blogCategoy.add',$data);
    }



    public function insertBlogCategoy(Request $request) 
    {
        // dd($request->all());

        request()->validate([
            'slug' => 'required|unique:blog_categories', 
        ]);

        $category = new BlogCategory;
        $category->name =  trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);

        $category->save();

        return redirect('blogs/categoy/list')->with('success',"Blog Category Successfully Created");
    }


    public function editBlogCategoy($id) 
    {
    
        $data['getRecord'] = BlogCategory::getSingle($id);
        $data['header_title'] = "Edit Blog Category";
        return view('backend.blogCategoy.edit',$data);
    }



    public function updateBlogCategoy($id, Request $request) 
    {
        request()->validate([
            'slug' => 'required|unique:blog_categories,slug,'.$id 
        ]);

        $category =  BlogCategory::getSingle($id);
        $category->name =  trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);

        $category->save();

        return redirect('blogs/categoy/list')->with('success',"Blog Category Successfully Updated");
    }


    public function deleteBlogCategoy($id) 
    {

        $user = BlogCategory::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect()->back()->with('deleting',"Blog Category Successfully Deleted");
    }
}
