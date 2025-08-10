<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\ShippingCharge;
use Request;



class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';


    static public function getSingle($id)
    {
        return self::find($id);
    }

    // user part
    static public function getUserTotalOrder($user_id)
    {
        return self::select('id')
                  ->where('user_id',  '=', $user_id)
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->count();
    }

    
    static public function getUserTotalTodayOrder($user_id)
    {
        return self::select('id')
                  ->where('user_id',  '=', $user_id)
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->whereDate('created_at',  '=', date('Y-m-d'))
                  ->count();
    }

    static public function getUserTotalAmount($user_id)
    {
        return self::select('id')
                  ->where('user_id',  '=', $user_id)
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->sum('total_amount');
    }

    
    static public function getUserTotalTodayAmount($user_id)
    {
        return self::select('id')
                  ->where('user_id',  '=', $user_id)
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->whereDate('created_at',  '=', date('Y-m-d'))
                  ->sum('total_amount');
    }


    static public function getUserTotalStatus($user_id, $status)
    {
        return self::select('id')
                  ->where('status',  '=', $status)
                  ->where('user_id',  '=', $user_id)
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->count();
    }

    static public function getUserRecord($user_id)
    {
        return  Order::select('orders.*')
                  ->where('user_id',  '=', $user_id)
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->orderBy('id', 'desc')
                  ->paginate(20);
    } 

    static public function getUserSingle($user_id,$id)
    {
        return  Order::select('orders.*')
                  ->where('user_id',  '=', $user_id)
                  ->where('id',  '=', $id)
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->first();
    }


    // End user part


    static public function getRecord()
    {
        $return = Order::select('orders.*');

                  if (!empty(Request::get('id')))
                  {
                     $return = $return->where('id',  '=', Request::get('id'));
                  } 

                  if (!empty(Request::get('company_name')))
                  {
                     $return = $return->where('company_name',  'like', '%'.Request::get('company_name').'%');
                  }

                  if (!empty(Request::get('first_name')))
                  {
                     $return = $return->where('first_name',  'like', '%'.Request::get('first_name').'%');
                  }

                  if (!empty(Request::get('last_name')))
                  {
                     $return = $return->where('last_name',  'like', '%'.Request::get('last_name').'%');
                  }

                  if (!empty(Request::get('email')))
                  {
                     $return = $return->where('email',  'like', '%'.Request::get('email').'%');
                  }

                  if (!empty(Request::get('phone')))
                  {
                     $return = $return->where('phone',  'like', '%'.Request::get('phone').'%');
                  }


                  if (!empty(Request::get('country')))
                  {
                     $return = $return->where('country',  'like', '%'.Request::get('country').'%');
                  }

                  if (!empty(Request::get('state')))
                  {
                     $return = $return->where('state',  'like', '%'.Request::get('state').'%');
                  }

                  if (!empty(Request::get('city')))
                  {
                     $return = $return->where('city',  'like', '%'.Request::get('city').'%');
                  }

                  if (!empty(Request::get('postcode')))
                  {
                     $return = $return->where('postcode',  'like', '%'.Request::get('postcode').'%');
                  }
                  

                  if (!empty(Request::get('form_date')))
                  {
                     $return = $return->where('created_at',  '>=', Request::get('form_date'));
                  }

                  if (!empty(Request::get('to_date')))
                  {
                     $return = $return->where('created_at',  '<=', Request::get('to_date'));
                  }

        $return = $return->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->orderBy('id', 'desc')
                  ->paginate(30);

          return $return;
    } 


    public function getShipping()
    {
        return $this->belongsTo(ShippingCharge::class, 'shipping_id');
    }


    public function getItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }


    static public function getTotalOrder()
    {
        return self::select('id')
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->count();
    }

    
    static public function getTotalTodayOrder()
    {
        return self::select('id')
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->whereDate('created_at',  '=', date('Y-m-d'))
                  ->count();
    }

    static public function getTotalAmount()
    {
        return self::select('id')
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->sum('total_amount');
    }

    
    static public function getTotalTodayAmount()
    {
        return self::select('id')
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->whereDate('created_at',  '=', date('Y-m-d'))
                  ->sum('total_amount');
    }

    
    static public function getLatestOrders()
    {
       return  Order::select('orders.*')
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->orderBy('id', 'desc')
                  ->limit(10)
                  ->get();
    }

    
    static public function getTotalOrderMonth($start_date, $end_date)
    {
        return self::select('id')
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->whereDate('created_at',  '>=', $start_date)
                  ->whereDate('created_at',  '<=', $end_date)
                  ->count();
    }

    static public function getTotalAmountMonth($start_date, $end_date)
    {
        return self::select('id')
                  ->where('is_payment',  '=', 1)
                  ->where('is_delete',  '=', 0)
                  ->whereDate('created_at',  '>=', $start_date)
                  ->whereDate('created_at',  '<=', $end_date)
                  ->sum('total_amount');
    }
}
