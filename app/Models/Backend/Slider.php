<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';

    static public function getRecord() 
    {
        return self::select('sliders.*')
         ->where('sliders.is_delete',  '=', 0)
         // ->where('sliders.status',  '=', 0)
         ->orderBy('sliders.id', 'desc')
         ->paginate(20);   
    }


    static public function getSingle($id)
    {
        return self::find($id);
    }


    static public function getRecordActive() 
    {
        return self::select('sliders.*')
         ->where('sliders.is_delete',  '=', 0)
         ->where('sliders.status',  '=', 0)
         ->orderBy('sliders.id', 'asc')
         ->get();   
    }

    public function getSliderImage()
    {
        if(!empty($this->image_name) && file_exists('public/upload/slider/'.$this->image_name))
          {
            return url('public/upload/slider/'.$this->image_name);
          }
          else
          {
            return "";
          }
    }
}
