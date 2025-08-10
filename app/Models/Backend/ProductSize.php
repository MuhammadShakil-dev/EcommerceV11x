<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $table = 'product_sizes';


    static public function deleteRecord($product_id)
    {
        return self::where('product_id',  '=', $product_id)->delete();
    }

    static public function getSingle($id)
    {
        return self::find($id); 
    }

    
}
