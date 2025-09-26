<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $this->validate($request, [
                'email'=>'required|email|max:255',
                'password'=>'required',
            ], [
                'email.required'=>'Email is required',
                'email.email'=>'Valid email is required',
                'password.required'=>'Password is required',
            ]);

            if (Auth::guard('admin')->attempt([
                'email'=>$data['email'],
                'password'=>$data['password'],
                'status'=>1,
            ])) {
                return redirect()->route('dashboard.admin');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }
        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login.admin');
    }

    public function updateAdminPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if (empty($data['old_password'])) {
                return redirect()->back()->with('error_message', 'Old Password is required');
            } elseif (empty($data['password'])) {
                return redirect()->back()->with('error_message', 'New Password is required');
            } elseif (empty($data['confirm_password'])) {
                return redirect()->back()->with('error_message', 'Confirm Password is required');
            } elseif ($data['password'] != $data['confirm_password']) {
                return redirect()->back()->with('error_message', 'New Password and Confirm Password does not match');
            } elseif (strlen($data['password']) < 6) {
                return redirect()->back()->with('error_message', 'New Password must be at least 6 characters');
            } else {
                if (Auth::guard('admin')->check()) {
                    $current_password = Auth::guard('admin')->user()->password;
                    if (password_verify($data['old_password'], $current_password)) {
                        $admin_id = Auth::guard('admin')->user()->id;
                        $new_password = bcrypt($data['password']);
                        \App\Models\Admin::where('id', $admin_id)->update(['password'=>$new_password]);
                        return redirect()->back()->with('success_message', 'Password updated successfully');
                    } else {
                        return redirect()->back()->with('error_message', 'Your current password is incorrect');
                    }
                }
            }
        }
    }

    public function updateAdminProfile(Request $request)
    {
        $admin_id = Auth::guard('admin')->user();
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'name'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
                'mobile'=>'required|numeric',
                'email'=>'required|email|max:255',
                'type' => 'required',
                'image' => 'mimes:JPG,jpeg,jpg,png,gif',
            ], [
                'name.required'=>'Name is required',
                'name.regex'=>'Valid Name is required',
                'email.required'=>'Email is required',
                'email.email'=>'Valid email is required',
                'mobile.required'=>'Mobile is required',
                'mobile.numeric'=>'Valid Mobile is required',
                'type.required'=>'Admin type is required',
                'image.mimes'=>'Valid Image is required (jpeg, jpg, png, gif)',
            ]);
            
            // upload image
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if (!is_null($file)) {
                    File::delete(public_path('/user/photo/'. $admin_id->image));
                    $imageName = 'admin_' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('/user/photo'), $imageName);
                }
            } elseif (!empty($request['current_image'])) {
                $imageName = $request['current_image'];
            } else {
                $imageName = "";
            }

            \App\Models\Admin::where('id', $admin_id->id)->update([
                'name'=>$request['name'], 
                'mobile'=>$request['mobile'],
                'email'=>$request['email'],
                'type'=>$request['type'],
                'image'=>$imageName
            ]);

            return redirect()->back()->with('success_message', 'Profile updated successfully');
        }
    }
}
