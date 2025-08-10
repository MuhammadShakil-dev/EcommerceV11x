<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Blog extends Model
{
    use HasFactory;


    protected $table = 'blogs';


    static public function getRecord() 
    {

        // join Query
        return self::select('blogs.*')
                   ->where('blogs.is_delete',  '=', 0)
                   ->orderBy('blogs.id', 'desc')
                   ->paginate(20);   
    }


    static public function getSingle($id)
    {
        return self::find($id);   // self to Category 
    }

    static public function getRecordActive() 
    {
        // join Query
        return self::select('blogs.*')
                     ->where('blogs.is_delete',  '=', 0)
                     ->where('blogs.status',  '=', 0)
                     ->orderBy('blogs.name', 'asc')
                     ->get();   
    }



    static public function getSingleSlug($slug)
    {
        return self::where('slug',  '=', $slug)
                     ->where('blogs.status',  '=', 0)
                     ->where('blogs.is_delete',  '=', 0)
                     ->first();
    }

    public function getImage()
    {
        if(!empty($this->image_name) && file_exists('public/upload/blog/'.$this->image_name))
          {
            return url('public/upload/blog/'.$this->image_name);
          }
          else
          {
            return "";
          }
    }


    static public function getBlog($blog_category_id = '') 
    {
        $return = self::select('blogs.*');

           if (!empty(Request::get('search')))
           {
               $return  = $return->where('blogs.title',  'like', '%'.Request::get('search').'%');

           }

           if (!empty($blog_category_id))
           {
               $return  = $return->where('blogs.blog_category_id',  '=', $blog_category_id);
           }

        $return  = $return->where('blogs.is_delete',  '=', 0)
                   ->where('blogs.status',  '=', 0)
                   ->orderBy('blogs.id', 'desc')
                   ->paginate(6); 

        return $return;  
    }


    public function getCategory()
    {
         return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }


    static public function getPopular() 
    {
        $return = self::select('blogs.*');

        $return  = $return->where('blogs.is_delete',  '=', 0)
                   ->where('blogs.status',  '=', 0)
                   ->orderBy('blogs.total_view', 'desc')
                   ->limit(6)
                   ->get(); 

        return $return;  
    }


    static public function getRelatedPost($blog_category_id, $blog_id)
    {
        $return = self::select('blogs.*');

        $return  = $return->where('blogs.is_delete',  '=', 0)
                   ->where('blogs.blog_category_id',  '=', $blog_category_id)
                   ->where('blogs.id',  '!=', $blog_id)
                   ->where('blogs.status',  '=', 0)
                   ->orderBy('blogs.total_view', 'desc')
                   ->limit(6)
                   ->get(); 

        return $return;  
    }


    public function getComment()
    {
        return $this->hasMany(BlogComment::class, 'blog_id')
                    ->select('blog_comments.*')
                    ->join('users', 'users.id', '=', 'blog_comments.user_id')
                    ->orderBy('blog_comments.id', 'desc');   
    }


    public function getCommentCount()
    {
        return $this->hasMany(BlogComment::class, 'blog_id')
                    ->select('blog_comments.id')
                    ->join('users', 'users.id', '=', 'blog_comments.user_id')
                    ->count();   
    }

    static public function getRecordActiveHome() 
    {
        return self::select('blogs.*')
                     ->where('blogs.is_delete',  '=', 0)
                     ->where('blogs.status',  '=', 0)
                     ->orderBy('blogs.id', 'asc')
                     ->limit(3)   
                     ->get();   
    }

}
