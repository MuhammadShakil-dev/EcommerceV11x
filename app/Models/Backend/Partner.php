<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory; 


    protected $table = 'partners';

    static public function getRecord() 
    {
        return self::select('partners.*')
         ->where('partners.is_delete',  '=', 0)
         // ->where('partners.status',  '=', 0)
         ->orderBy('partners.id', 'desc')
         ->paginate(20);   
    }


    static public function getSingle($id)
    {
        return self::find($id);
    }


    static public function getRecordActive() 
    {
        return self::select('partners.*')
         ->where('partners.is_delete',  '=', 0)
         ->where('partners.status',  '=', 0)
         ->orderBy('partners.id', 'asc')
         ->get();   
    }

    public function getPartnerLogo()
    {
        if(!empty($this->image_name) && file_exists('public/upload/partner/'.$this->image_name))
          {
            return url('public/upload/partner/'.$this->image_name);
          }
          else
          {
            return "";
          }
    }

}
