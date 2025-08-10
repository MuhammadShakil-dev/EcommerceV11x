<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Blog;
use App\Models\Backend\BlogCategory;
use Auth;
use Hash;
use Str;

class BlogController extends Controller
{
    //
    public function listBlog() 
    {
        $data['getRecord'] = Blog::getRecord();
        $data['header_title'] = "Blog";
        return view('backend.blog.list',$data);
    }

     public function addBlog()
    {
        $data['getCategory'] = BlogCategory::getRecordActive();
        $data['header_title'] = "Add New Blog";
        return view('backend.blog.add',$data);
    }



    public function insertBlog(Request $request) 
    {
        // dd($request->all());

        $blog = new Blog;
        $blog->title =  trim($request->title);
        $blog->blog_category_id = trim($request->blog_category_id);
        $blog->short_description = trim($request->short_description);
        $blog->description = trim($request->description);
        $blog->status = trim($request->status);
        $blog->meta_title = trim($request->meta_title);
        $blog->meta_description = trim($request->meta_description);
        $blog->meta_keywords = trim($request->meta_keywords);

        if (!empty($request->file('image_name')))
        {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/upload/blog/', $filename);
            $blog->image_name = trim($filename);
        }

        $slug = Str::slug($request->title);
        $count = Blog::where('slug', '=', $slug)->count();
        if (!empty($count)) 
        {
            $blog->slug = $slug.'_'.$blog->id;

        }
        else
        {
            $blog->slug = trim($slug);

        }

        $blog->save();

        return redirect('bblogs/blog/list')->with('success',"Blog Successfully Created");
    }


    public function editBlog($id) 
    {
    
        $data['getCategory'] = BlogCategory::getRecordActive();
        $data['getRecord'] = Blog::getSingle($id);
        $data['header_title'] = "Edit Blog";
        return view('backend.blog.edit',$data);
    }



    public function updateBlog($id, Request $request) 
    {

        $blog =  Blog::getSingle($id);
        $blog->title =  trim($request->title);
        $blog->blog_category_id = trim($request->blog_category_id); 
        $blog->short_description = trim($request->short_description);
        $blog->description = trim($request->description);
        $blog->status = trim($request->status);
        $blog->meta_title = trim($request->meta_title);
        $blog->meta_description = trim($request->meta_description);
        $blog->meta_keywords = trim($request->meta_keywords);
        $blog->save();


        if (!empty($request->file('image_name')))
        {
            if(!empty($blog->getImage()))
            {
                //
                 unlink('public/upload/blog/'.$blog->image_name);

            }
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/upload/blog/', $filename);
            $blog->image_name = trim($filename);
            $blog->save();

        }


        return redirect('bblogs/blog/list')->with('success',"Blog Successfully Updated");
    }


    public function deleteBlog($id) 
    {

        $blog = Blog::getSingle($id);
        $blog->is_delete = 1;
        $blog->save();

        return redirect()->back()->with('deleting',"Blog Successfully Deleted");
    }
}
