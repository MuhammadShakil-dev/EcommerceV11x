<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory; 


    protected $table = 'system_settings';



    static public function getSingle()
    {
        return self::find(1); 
    }


    public function getLogo()
    {
        if(!empty($this->logo) && file_exists('public/upload/setting/'.$this->logo))
          {
            return url('public/upload/setting/'.$this->logo);
          }
          else
          {
            return "";
          }
    }

    public function getFevicon()
    {
        if(!empty($this->fevicon) && file_exists('public/upload/setting/'.$this->fevicon))
          {
            return url('public/upload/setting/'.$this->fevicon);
          }
          else
          {
            return "";
          }
    }

    public function getPaymentIcon()
    {
        if(!empty($this->footer_payment_icon) && file_exists('public/upload/setting/'.$this->footer_payment_icon))
          {
            return url('public/upload/setting/'.$this->footer_payment_icon);
          }
          else
          {
            return "";
          }
    }


}
