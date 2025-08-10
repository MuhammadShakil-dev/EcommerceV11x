<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';


    static public function getRecord() 
    {
        // return self::get();   
        // return Controller::get();

        // join Query
        return self::select('categories.*', 'users.name as created_by_name')
                   ->join('users', 'users.id', '=', 'categories.created_by')
                   ->where('categories.is_delete',  '=', 0)
                   ->orderBy('categories.id', 'desc')
                   ->get();   
    }


    static public function getSingle($id)
    {
        return self::find($id);   // self to Category 
    }

    static public function getRecordActive() 
    {
        // join Query
        return self::select('categories.*')
                     ->join('users', 'users.id', '=', 'categories.created_by')
                     ->where('categories.is_delete',  '=', 0)
                     ->where('categories.status',  '=', 0)
                     ->orderBy('categories.name', 'asc')
                     ->get();   
    }


    static public function getRecordActiveHome() 
    {
        // join Query
        return self::select('categories.*')
                     ->join('users', 'users.id', '=', 'categories.created_by')
                     ->where('categories.is_home',  '=', 1)
                     ->where('categories.is_delete',  '=', 0)
                     ->where('categories.status',  '=', 0)
                     ->orderBy('categories.id', 'asc')
                     ->get();   
    }


    static public function getRecordMenu() 
    {
        return self::select('categories.*')
                     ->join('users', 'users.id', '=', 'categories.created_by')
                     ->where('categories.is_delete',  '=', 0)
                     ->where('categories.status',  '=', 0)
                     ->get();   
    }


    static public function getRecordHeaderMenu() 
    {
        return self::select('categories.*')
                     ->join('users', 'users.id', '=', 'categories.created_by')
                     ->where('categories.is_delete',  '=', 0)
                     ->where('categories.status',  '=', 0)
                     ->where('categories.is_menu',  '=', 1)
                     ->get();   
    }

    


    public function getSubCategory()
    {
        return $this->hasMany(SubCategory::class, "category_id")
                    ->where('sub_categories.status', '=', 0)
                    ->where('sub_categories.is_delete', '=', 0); 
                    }


    static public function getSingleSlug($slug)
    {
        return self::where('slug',  '=', $slug)
                     ->where('categories.status',  '=', 0)
                     ->where('categories.is_delete',  '=', 0)
                     ->first();
    }


    public function getImage()
    {
        if(!empty($this->image_name) && file_exists('public/upload/category/'.$this->image_name))
          {
            return url('public/upload/category/'.$this->image_name);
          }
          else
          {
            return "";
          }
    }
    
}
