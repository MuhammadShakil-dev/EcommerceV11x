<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use App\Models\Backend\Notification;

class AdminController extends Controller
{

    public function ListAdmin()
    {
        $data['getRecord'] = User::getAdmin();
        $data['header_title'] = "Admin";
        return view('backend.admin.list',$data);
    }

    public function addAdmin()
    {
        $data['header_title'] = "Add Newb Admin";
        return view('backend.admin.add',$data);
    }


    public function insertAdmin(Request $request) 
    {
        // dd($request->all());

        // $permissionRole = PermissionRole::getPermission('Add User', Auth::user()->role_id);
        // if (empty($permissionRole)) 
        // {
        //     abort(404);
        // }

        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->is_admin = 1;
        $user->save();

        return redirect('admins/admin/list')->with('success',"Admin Successfully Created");
    }

    public function editAdmin($id) 
    {
        
        // $permissionRole = PermissionRole::getPermission('Edit Role', Auth::user()->role_id);
        // if (empty($permissionRole)) 
        // {
        //     abort(404);
        // }

        // $data['getRecord'] = Role::getSingle($id);
        // $data['getPermission'] = Permission::getRecord();
        // $data['getRolePermission'] = PermissionRole::getRolePermission($id);
        // return view('roles.edit',$data);

        $data['getRecord'] = User::getSingle($id);
        $data['header_title'] = "Edit Admin";
        return view('backend.admin.edit',$data);
    }

    public function updateAdmin($id, Request $request) 
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);
        
        $user = User::getSingle($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) 
        {
            $user->password = Hash::make($request->password);  
        }
        $user->status = $request->status;
        $user->is_admin = 1;
        $user->save();

        return redirect('admins/admin/list')->with('success',"Admin Successfully Updated");

    }

    public function deleteAdmin($id) 
    {

        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect()->back()->with('deleting',"Record Successfully Deleted");
    }

    public function Listcustomer(Request $request)
    {
        if (!empty($request->notification_id))
        {
            Notification::updateReadNotification($request->notification_id);
        }

        $data['getRecord'] = User::getCustomer();
        $data['header_title'] = "Customer";
        return view('backend.customer.list',$data);
    }
}
