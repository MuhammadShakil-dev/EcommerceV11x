<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory; 

    protected $table = 'payment_settings';


    static public function getSingle()
    {
        return self::find(1);
    }

}
