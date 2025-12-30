<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function loginRegister()
    {
        return view('front.vendor.login_register');
    }

    public function vendorLogin(Request $request)
    {
        // Logic for vendor login
    }

    public function vendorRegister(Request $request)
    {
        // Logic for vendor registration
        if ($request->isMethod('POST')) {
            $data = $request->all();
            // Validation rules
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:vendors|unique:admins',
                'mobile' => 'required|string|min:11|max:15|unique:vendors|unique:admins',
                'accept' => 'required',
                'password' => 'required|string|min:6',
            ];

            $customMessages = [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Valid email is required',
                'email.unique' => 'Email already exists',
                'mobile.required' => 'Mobile number is required',
                'mobile.min' => 'Mobile number must be at least 11 digits',
                'mobile.max' => 'Mobile number must not exceed 15 digits',
                'mobile.unique' => 'Mobile number already exists',
                'accept.required' => 'You must accept the terms and conditions',
                'password.required' => 'Password is required',
            ];

            $validator = Validator::make($data, $rules, $customMessages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            // Create the vendor
            // insert new vendor into vendors table
            $vendor = new Vendor();
            $vendor->name = $data['name'];
            $vendor->email = $data['email'];
            $vendor->mobile = $data['mobile'];
            $vendor->status = 0; // Set status to inactive initially
            $vendor->save();

            $vendor_id = DB::getPdo()->lastInsertId();

            // insert new vendor to admins table
            $admin = new Admin();
            $admin->vendor_id = $vendor_id;
            $admin->name = $data['name'];
            $admin->type = 'vendor';
            $admin->mobile = $data['mobile'];
            $admin->email = $data['email'];
            $admin->password = bcrypt($data['password']);
            $admin->status = 0; // Set status to inactive initially
            $admin->save();

            DB::commit();

            // send confirmation email to vendor

            // redirect to vendor login/register page with success message
            $message = 'Your registration request has been submitted successfully! Please wait for admin approval.';
            return redirect()->back()->with('success_message', $message);

        }
    }
}
