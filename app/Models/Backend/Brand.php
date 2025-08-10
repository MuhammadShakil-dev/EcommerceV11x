<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    static public function getRecord() 
    {
        // join Query
        return self::select('brands.*', 'users.name as created_by_name')
         ->join('users', 'users.id', '=', 'brands.created_by')
         ->where('brands.is_delete',  '=', 0)
         ->orderBy('brands.id', 'desc')
         ->get();   
    }


    static public function getSingle($id)
    {
        return self::find($id);
    } 


    static public function getRecordActive() 
    {
        return self::select('brands.*')
         ->join('users', 'users.id', '=', 'brands.created_by')
         ->where('brands.is_delete',  '=', 0)
         ->where('brands.status',  '=', 0)
         ->orderBy('brands.name', 'asc')
         ->get();   
    }

}
