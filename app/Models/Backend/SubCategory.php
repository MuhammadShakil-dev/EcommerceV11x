<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';

    static public function getRecord() 
    {
        // join Query
        return self::select('sub_categories.*', 'users.name as created_by_name','categories.name as category_name')
         ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
         ->join('users', 'users.id', '=', 'sub_categories.created_by')
         ->where('sub_categories.is_delete',  '=', 0)
         ->orderBy('sub_categories.id', 'desc')
         ->paginate(20);   
    }

    static public function getSingle($id)
    {
        return self::find($id);   // self to Category 
    }

    static public function getRecordSubCategory($category_id) 
    {
        // join Query
        return self::select('sub_categories.*')
         ->join('users', 'users.id', '=', 'sub_categories.created_by')
         ->where('sub_categories.is_delete',  '=', 0)
         ->where('sub_categories.status',  '=', 0) 
         ->where('sub_categories.category_id',  '=', $category_id)
         ->orderBy('sub_categories.name', 'asc')
         ->get();
    }


    static public function getSingleSlug($slug)
    {
        return self::where('slug',  '=', $slug)
                     ->where('sub_categories.status',  '=', 0)
                     ->where('sub_categories.is_delete',  '=', 0)
                     ->first();
    }


    public function totalProduct()
    {
        return $this->hasMany(Product::class, 'sub_category_id')
                    ->where('products.is_delete',  '=', 0)
                    ->where('products.status',  '=', 0) 
                    ->count();
    }

    

}
