<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Hash;
use Str;
use App\Models\User;
use Mail;
use App\Mail\RegisterMail;
use App\Mail\ForgotPasswordMail;
use App\Models\Backend\Notification;

class FrontendAuthController extends Controller
{

    public function frontendAuthRegister(Request $request) 
    {
        // dd($request->all());

        // request()->validate([
        //     'email' => 'required|email|unique:users',
        // ]);

        $checkEmail = User::checkEmail($request->email);
         if(empty($checkEmail)) 
         {
            $save = new User;
            $save->name = trim($request->name);
            $save->email = trim($request->email);
            $save->password = Hash::make($request->password);
            $save->save();

            // for email...
            // Mail::to($save->email)->send(new RegisterMail($save));
            try 
            {
                Mail::to($save->email)->send(new RegisterMail($save));
            }
            catch (\Exception $e)
            {
                //
            }


             // .....Notification.....
             // $user_id = $save->id;
             $user_id = 1; // 1 = admin
             $url = url('admins/customer/list');
             $message = "New Customer Register #".$save->name;

             Notification::insertRecord($user_id, $url, $message);
             // ...../Notification.....

            $json['status'] = true;
            $json['message'] = "Your account successfully created. Please verify your email address";
         }
         else
         {
            $json['status'] = false;
            $json['message'] = "This email is already register please try another";
         }

         echo json_encode($json);
    }  


    public function activateEmail($id)
    {
        $id = base64_decode($id);
        $user = User::getSingle($id);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect(url(''))->with('success', "Email successfully verified");
    }


    public function frontendAuthLogin(Request $request) 
    {
        // dd($request->all());

        $remember = !empty($request->is_remember) ? true : false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 0,'is_delete' => 0], $remember))
       { 
         if(!empty(Auth::user()->email_verified_at)) 
         {
             // return view('CustomAuth/dashboard');
             // return view('dashboard');
             // return redirect()->route('panel/dashboard');
             // return redirect('backend/dashboard');

               $json['status'] = true;
               $json['message'] = "Success";
         }
         else
         {
            // for email verify...
            $save = User::getSingle(Auth::user()->id);

            // Mail::to($save->email)->send(new RegisterMail($save));
            try 
            {
                Mail::to($save->email)->send(new RegisterMail($save));
            }
            catch (\Exception $e)
            {
                //
            }

            Auth::logout();

            $json['status'] = false;
            $json['message'] = "Your email is not verified. Please verify your email address first";
         }

         


       }
       else
       {

         $json['status'] = false;
         $json['message'] = "Please enter correct email and password";

       }

       echo json_encode($json);

    }



    public function frontendForgotPassword(Request $request) 
    {
        
        $data['meta_title'] = "Forgot Password";
         return view('frontend.frontendAuth.forgot_password', $data);
    }

    

    public function frontendAuthForgotPassword(Request $request) 
    {
        $user = User::where('email', '=', $request->email)->first();
        if (!empty($user)) 
        {
            // code...
            $user->remember_token = Str::random(30);
            $user->save();


            // Mail::to($user->email)->send(new ForgotPasswordMail($user));
            try 
            {
                Mail::to($user->email)->send(new ForgotPasswordMail($user));
            }
            catch (\Exception $e)
            {
                //
            }

            return redirect()->back()->with('success', "Please check your email and reset your password");
        }
        else
        {
            return redirect()->back()->with('error', "Email not found in the system.");
        }
    }

    
    public function frontendResetPassword($token) 
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) 
        {
            $user['user'] = $user;
            $data['meta_title'] = "Reset Password";

            return view('frontend.frontendAuth.reset_password', $data);

        }
        else
        {
            abort(404);
        }
    }
    

    public function frontendAuthResetPassword($token, Request $request) 
    {
        if ($request->password == $request->cpassword)
         {
            
            $user = User::where('remember_token', '=', $token)->first();
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();

            return redirect(url(''))->with('success', "Password successfully reset.");
        }
        else
        {
            return redirect()->back()->with('error', "Password or confirm password does not match.");

        }
    }





}
