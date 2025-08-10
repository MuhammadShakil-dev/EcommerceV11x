<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMTP extends Model 
{
    use HasFactory;


    protected $table = 's_m_t_p_s';


    static public function getSingle()
    {
        return self::find(1);
    }
}
