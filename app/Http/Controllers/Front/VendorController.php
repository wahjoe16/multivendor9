<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
            $admin->type = 'Vendor';
            $admin->mobile = $data['mobile'];
            $admin->email = $data['email'];
            $admin->password = bcrypt($data['password']);
            $admin->status = 0; // Set status to inactive initially
            $admin->save();

            DB::commit();

            // send confirmation email to vendor
            $email = $data['email'];
            $messageData = [
                'email' => $data['email'],
                'name' => $data['name'],
                'code' => base64_encode($data['email']),
            ];

            Mail::send('front.emails.vendor_registration_confirmation', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Vendor Registration Confirmation - ' . env('APP_NAME'));
            });

            // redirect to vendor login/register page with success message
            $message = 'Your registration request has been submitted successfully! Please wait for admin approval.';
            return redirect()->back()->with('success_message', $message);

        }
    }

    public function vendorConfirmation($email)
    {
        // Logic for vendor email confirmation
        $email = base64_decode($email); // Decode vendor email

        // check if vendor email exists
        $vendorCount = Vendor::where('email', $email)->count();
        if ($vendorCount > 0) {
            // Vendor email is already activated or not
            $vendorDetails = Vendor::where('email', $email)->first();
            if ($vendorDetails->confirm == "Yes") {
                $message = 'Your email is already confirmed. You can login now.';
                return redirect()->route('vendor.login.register')->with('error_message', $message);
            } else {
                // update confirm column to Yes in vendors table and admins table to activate vendor account
                Admin::where('email', $email)->update(['confirm' => 'Yes']);
                Vendor::where('email', $email)->update(['confirm' => 'Yes']);

                // send register email
                $messageData = [
                    'email' => $email,
                    'name' => $vendorDetails->name,
                    'mobile' => $vendorDetails->mobile,
                ];

                Mail::send('front.emails.vendor_confirmed', $messageData, function($message) use ($email) {
                    $message->to($email)->subject('Vendor Account Confirmed - ' . env('APP_NAME'));
                });

                // redirect to vendor login/register page with success message
                $message = 'Your email has been confirmed successfully! You can login now.';
                return redirect()->route('vendor.login.register')->with('success_message', $message);
            }
        } else {
            abort(404);
        }
    }
}
