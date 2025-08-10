<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;


    protected $table = 'blog_categories';


    static public function getRecord() 
    {

        // join Query
        return self::select('blog_categories.*')
                   ->where('blog_categories.is_delete',  '=', 0)
                   ->orderBy('blog_categories.id', 'desc')
                   ->get();   
    }


    static public function getSingle($id)
    {
        return self::find($id);   // self to Category 
    }

    static public function getRecordActive() 
    {
        // join Query
        return self::select('blog_categories.*')
                     ->where('blog_categories.is_delete',  '=', 0)
                     ->where('blog_categories.status',  '=', 0)
                     ->orderBy('blog_categories.name', 'asc')
                     ->get();   
    }


    static public function getRecordActiveHome() 
    {
        // join Query
        return self::select('blog_categories.*')
                     ->where('blog_categories.is_home',  '=', 1)
                     ->where('blog_categories.is_delete',  '=', 0)
                     ->where('blog_categories.status',  '=', 0)
                     ->orderBy('blog_categories.id', 'asc')
                     ->get();   
    }


    static public function getSingleSlug($slug)
    {
        return self::where('slug',  '=', $slug)
                     ->where('blog_categories.status',  '=', 0)
                     ->where('blog_categories.is_delete',  '=', 0)
                     ->first();
    }




    public function getBlogCount()
    {
        return $this->hasMany(Blog::class, 'blog_category_id')
                     ->where('blogs.status',  '=', 0)
                     ->where('blogs.is_delete',  '=', 0)
                     ->count();
    }

}
