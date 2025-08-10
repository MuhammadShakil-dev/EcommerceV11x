<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Page;
use App\Models\Backend\ContactUs;
use App\Models\User;
use Auth;
use Str;

class PagesController extends Controller
{

    public function contactUsList()
    {
        $data['getRecord'] = ContactUs::getRecord();
        $data['header_title'] = "contact Us";
        return view('backend.contactus.list',$data);
    }


    public function contactUsDelete($id)
    {
        //
        ContactUs::where('id', '=', $id)->delete();

        return redirect()->back()->with('deleting',"Record Successfully Deleted");

    }


    public function listPage()
    {
        $data['getRecord'] = Page::getRecord();
        $data['header_title'] = "Page";
        return view('backend.pages.list',$data);
    }


    public function addPage()
    {
        $data['header_title'] = "Add New Page";
        return view('backend.pages.add',$data);
    }

    

    public function insertPage(Request $request) 
    {
        // dd($request->all());

        $name =  trim($request->name);
        $page = new Page;
        $page->name =  $name;
        $page->created_by = Auth::user()->id; 
        $page->save();

        $slug = Str::slug($name, "-");
        
        $checkSlug = Page::checkPageSlug($slug);
         if (empty($checkSlug))
         {
            $page->slug =  $slug;
            $page->save();
         }
         else
         {
            $newSlug=  $slug.'-' .$page->id;
            $page->slug =  $newSlug;
            $page->save();
         }

        return redirect('pages/page/edit/'.$page->id);
    }


    public function editPage($id) 
    {
    
        $data['getRecord'] = Page::getSingle($id);
        $data['header_title'] = "Edit Page";
        return view('backend.pages.edit',$data);
    }


    public function updatePage($id, Request $request) 
    {
        // dd($request->all());
        
        $page =  Page::getSingle($id);
        $page->name =  trim($request->name);
        $page->title = trim($request->title);
        $page->description = trim($request->description);
        $page->meta_title = trim($request->meta_title);
        $page->meta_description = trim($request->meta_description);
        $page->meta_keywords = trim($request->meta_keywords);
        $page->save();

        // images
        if (!empty($request->file('image')))
        {
          $file = $request->file('image');
          $ext = $file->getClientOriginalExtension();
          $randomStr = $page->id.Str::random(20);
          $filename = strtolower($randomStr).'.'.$ext;
          $file->move('public/upload/page/', $filename);

          $page->image_name = trim($filename);
          $page->save();           
        }

        return redirect('pages/page/list')->with('success',"Page Successfully Updated");
    }


}
