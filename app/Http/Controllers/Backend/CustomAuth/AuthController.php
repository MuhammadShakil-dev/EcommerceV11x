<?php

namespace App\Http\Controllers\Backend\CustomAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;

class AuthController extends Controller
{
    //
    public function adminLogin()
    {
        // dd(Hash::make(123456));
        
        if (!empty(Auth::check()) && Auth::user()->is_admin == 1)
         {
          return redirect('backend/dashboard');
         }

         return view('backend.customAuth.login');
    }

    public function adminAuthLogin(Request $request)
    {

        // dd($request->all());
       $remember = !empty($request->remember) ? true : false;
       
       if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1,'status' => 0,'is_delete' => 0], $remember))
       {

        // return view('CustomAuth/dashboard');
        // return view('dashboard');
         // return redirect()->route('panel/dashboard');
         return redirect('backend/dashboard');

       }
       else
       {

        return redirect()->back()->with('error', "Please enter correct email and password");

       }
    }



    public function adminLogout()
    {
        Auth::logout();
        return redirect(url(''));
        // return redirect('customAuths/login');
    }
}
