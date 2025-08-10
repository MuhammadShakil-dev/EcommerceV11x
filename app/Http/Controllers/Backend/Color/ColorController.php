<?php

namespace App\Http\Controllers\Backend\Color;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Color;
use Auth;

class ColorController extends Controller
{
     
    public function listColor()
    {
        $data['getRecord'] = Color::getRecord();
        $data['header_title'] = "Color";
        return view('backend.color.list',$data);
    }


    public function addColor()
    {
        $data['header_title'] = "Add New Color";
        return view('backend.color.add',$data);
    }


    public function insertColor(Request $request) 
    {

        $color = new Color;
        $color->name =  trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->created_by = Auth::user()->id; 
        $color->save();

        return redirect('colors/color/list')->with('success',"Color Successfully Created");
    }


    public function editColor($id) 
    {
    
        $data['getRecord'] = Color::getSingle($id);
        $data['header_title'] = "Edit Color";
        return view('backend.color.edit',$data);
    }



    public function updateColor($id, Request $request) 
    {
        
        $color =  Color::getSingle($id);
        $color->name =  trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->created_by = Auth::user()->id; 
        $color->save();

        return redirect('colors/color/list')->with('success',"Color Successfully Updated");
    }
    

    public function deleteColor($id) 
    {

        $color = Color::getSingle($id);
        $color->is_delete = 1;
        $color->save();

        return redirect()->back()->with('deleting',"Color Successfully Deleted");
    }

}
