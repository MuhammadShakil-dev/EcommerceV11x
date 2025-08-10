<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory; 

    protected $table = 'pages';

    

    static public function checkPageSlug($slug)
    {
        return self::where('slug',  '=', $slug)->first();
    }

    static public function getSingle($id)
    {
        return self::find($id); 
    }



    static public function getRecord()
    {
        return self::select('pages.*')
                     ->get();
    }


    public function getPageImage()
    {
        if(!empty($this->image_name) && file_exists('public/upload/page/'.$this->image_name))
          {
            return url('public/upload/page/'.$this->image_name);
          }
          else
          {
            return "";
          }
    }
}
