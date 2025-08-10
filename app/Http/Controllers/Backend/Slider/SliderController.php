<?php

namespace App\Http\Controllers\Backend\Slider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Slider;
use Auth;
use Str;

class SliderController extends Controller
{

     public function sliderList()
    {
        $data['getRecord'] = Slider::getRecord();
        $data['header_title'] = "Slider";
        return view('backend.slider.list',$data);
    }


    public function sliderAdd()
    {
        $data['header_title'] = "Add New Slider";
        return view('backend.slider.add',$data);
    }


    public function sliderInsert(Request $request) 
    {

        $slider = new Slider;
        $slider->title =  trim($request->title);
        $slider->button_name = trim($request->button_name);
        $slider->button_link = trim($request->button_link);
        
        $file = $request->file('image_name');
        $ext = $file->getClientOriginalExtension();
        $randomStr = Str::random(20);
        $filename = strtolower($randomStr).'.'.$ext;
        $file->move('public/upload/slider/', $filename);

        $slider->image_name = trim($filename);
        $slider->status = trim($request->status);
        $slider->save();

        return redirect('sliders/slider/list')->with('success',"Slider Successfully Created");
    }


    public function sliderEdit($id) 
    {
    
        $data['getRecord'] = Slider::getSingle($id);
        $data['header_title'] = "Edit Slider";
        return view('backend.slider.edit',$data);
    }



    public function sliderUpdate($id, Request $request) 
    {
        
        $slider =  Slider::getSingle($id);

        $slider->title =  trim($request->title);
        $slider->button_name = trim($request->button_name);
        $slider->button_link = trim($request->button_link);

        if (!empty($request->file('image_name')))
        {
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
           $file->move('public/upload/slider/', $filename);

           $slider->image_name = trim($filename);
        }
        
        $slider->status = trim($request->status);
        $slider->save();

        return redirect('sliders/slider/list')->with('success',"Slider Successfully Updated");
    }
    

    public function sliderDelete($id) 
    {

        $slider = Slider::getSingle($id);
        $slider->is_delete = 1;
        $slider->save();

        return redirect()->back()->with('deleting',"Slider Successfully Deleted");
    }
}
