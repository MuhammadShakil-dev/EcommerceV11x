<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    use HasFactory; 

    protected $table = 'home_settings';



    static public function getSingle()
    {
        return self::find(1); 
    }


    public function getPaymentDeliveryImage()
    {
        if(!empty($this->payment_delivery_image) && file_exists('public/upload/setting/homeSetting/'.$this->payment_delivery_image))
          {
            return url('public/upload/setting/homeSetting/'.$this->payment_delivery_image);
          }
          else
          {
            return "";
          }
    }

    public function getRefundImage()
    {
        if(!empty($this->refund_image) && file_exists('public/upload/setting/homeSetting/'.$this->refund_image))
          {
            return url('public/upload/setting/homeSetting/'.$this->refund_image);
          }
          else
          {
            return "";
          }
    }

    public function getSupportImage()
    {
        if(!empty($this->support_image) && file_exists('public/upload/setting/homeSetting/'.$this->support_image))
          {
            return url('public/upload/setting/homeSetting/'.$this->support_image);
          }
          else
          {
            return "";
          }
    }

    public function getSignupImage()
    {
        if(!empty($this->signup_image) && file_exists('public/upload/setting/homeSetting/'.$this->signup_image))
          {
            return url('public/upload/setting/homeSetting/'.$this->signup_image);
          }
          else
          {
            return "";
          }
    }


}
