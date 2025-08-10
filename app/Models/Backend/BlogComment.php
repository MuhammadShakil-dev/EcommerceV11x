<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class BlogComment extends Model
{
    use HasFactory; 


    protected $table = 'blog_comments';

    

    static public function getSingle($id)
    {
        return self::find($id);
    }


    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
