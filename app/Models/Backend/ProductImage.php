<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';


    public function getImageLog()
    {
        if(!empty($this->image_name) && file_exists('public/upload/product/'.$this->image_name))
          {
            return url('public/upload/product/'.$this->image_name);
          }
          else
          {
            return "";
          }
    }


    static public function getSingle($id)
    {
        return self::find($id);
    }

}
