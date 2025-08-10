<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payments\Order;
use App\Models\User;
use App\Models\Backend\ProductWishlist;
use App\Models\Backend\ProductReview;
use App\Models\Backend\Notification;
use Auth;
use Hash;

class UserController extends Controller
{
    public function userDashboard()
    {
        $data['meta_title'] = 'Dashboard';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $data['totalUserOrder']   = Order::getUserTotalOrder(Auth::user()->id);
        $data['totalUserTodayOrder']   = Order::getUserTotalTodayOrder(Auth::user()->id);
        $data['totalUserAmount']   = Order::getUserTotalAmount(Auth::user()->id);
        $data['totalUserTodayAmount']   = Order::getUserTotalTodayAmount(Auth::user()->id);

        $data['totalPendingUser']   = Order::getUserTotalStatus(Auth::user()->id, 0);
        $data['totalInProgressUser']   = Order::getUserTotalStatus(Auth::user()->id, 1);
        // $data['totalDeliveredUser']   = Order::getUserTotalStatus(Auth::user()->id, 2);
        $data['totalCompletedUser']   = Order::getUserTotalStatus(Auth::user()->id, 3);
        $data['totalCancelledUser']   = Order::getUserTotalStatus(Auth::user()->id, 4);

        return view('frontend.user.dashboard', $data);
    } 


    public function userOrder(Request $request)
    {
        if (!empty($request->notification_id))
        {
            Notification::updateReadNotification($request->notification_id);
        }
        
        $data['meta_title'] = 'Order';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getUserRecord']   = Order::getUserRecord(Auth::user()->id);

        return view('frontend.user.order', $data);
    } 

    public function userOrderDetail($id)
    {
        $data['getUserDetailRecord']   = Order::getUserSingle(Auth::user()->id,$id);
        if (!empty($data['getUserDetailRecord'])) 
        {
            $data['meta_title'] = 'Order Detail';
            $data['meta_description'] = '';
            $data['meta_keywords'] = '';

            return view('frontend.user.order_detail', $data);

        }
        else
        {
            abort(404);
        }

    }


    public function userEditProfile()
    {
        $data['meta_title'] = 'Edit Profile';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getSingleRecord']   = User::getSingle(Auth::user()->id);


        return view('frontend.user.edit_profile', $data);
    }

    
    public function userUpdateProfile(Request $request)
    {
        // dd($request->all());

        $user   = User::getSingle(Auth::user()->id);

        $user->name = trim($request->name);
        $user->last_name = trim($request->last_name);
        $user->company_name = trim($request->company_name);
        $user->country = trim($request->country);
        $user->street_address_one = trim($request->street_address_one);
        $user->street_address_two = trim($request->street_address_two);
        $user->city = trim($request->city);
        $user->state = trim($request->state);
        $user->postcode = trim($request->postcode);
        $user->phone = trim($request->phone);
        $user->save();

        return redirect()->back()->with('success', "Profile successfully Updated");
    }



    public function userChangePassword()
    {
        $data['meta_title'] = 'Change Password';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('frontend.user.change_password', $data);
    }


    public function userUpdatePassword(Request $request)
    {
        // dd($request->all());

        $user   = User::getSingle(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password))
        {
            if ($request->password == $request->cpassword)
            {
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with('success', "Password successfully Updated");

            }
            else
            {
                return redirect()->back()->with('error', "New Password and confirm Password does not match ");

            }
        }
        else
        {
            return redirect()->back()->with('error', "Old Password is not match ");

        }


    }

    
    public function userAddToWishlist(Request $request)
    {
        // dd($request->all());

        $check =  ProductWishlist::checkAlready($request->product_id, Auth::user()->id);
         if (empty($check))
         {
            $save = new ProductWishlist;
            $save->product_id = $request->product_id;
            $save->user_id = Auth::user()->id;
            $save->save();

            $json['is_wishlist'] = 1;

         }
         else
         {
            ProductWishlist::deleteRecord($request->product_id, Auth::user()->id);
            $json['is_wishlist'] = 0;

         }
        

        $json['status'] = true;
        echo json_encode($json);
    }

    
    public function userReview(Request $request)
    {
        // dd($request->all());

        $save   = new ProductReview;
        $save->product_id = trim($request->product_id);
        $save->order_id = trim($request->order_id);
        $save->user_id = Auth::user()->id;
        $save->rating = trim($request->rating);
        $save->review = trim($request->review);
        $save->save();

        return redirect()->back()->with('success', "Thank you for review");       


    }


    public function userNotification(Request $request)
    {

        $data['meta_title'] = 'Notification';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getRecordUser'] = Notification::getRecordUser(Auth::user()->id);

        return view('frontend.user.notification', $data);
    }


}
