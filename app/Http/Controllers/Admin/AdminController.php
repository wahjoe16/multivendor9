<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBankDetail;
use App\Models\VendorsBusinessDetail;
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

            // if (Auth::guard('admin')->attempt([
            //     'email'=>$data['email'],
            //     'password'=>$data['password'],
            //     'status'=>1,
            // ])) {
            //     return redirect()->route('dashboard.admin');
            // } else {
            //     return redirect()->back()->with('error_message', 'Invalid Email or Password');
            // }

            if (Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password']])) {
                if (Auth::guard('admin')->user()->type == "Vendor" && Auth::guard('admin')->user()->confirm == "No") {
                    return redirect()->back()->with('error_message', 'Please confirm email to activate your vendor account.');
                } elseif (Auth::guard('admin')->user()->type != "Vendor" && Auth::guard('admin')->user()->status == 0) {
                    return redirect()->back()->with('error_message', 'Your admin account is not active'); 
                } else {
                    return redirect()->route('dashboard.admin');
                }

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

    public function updateVendorProfile(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'personal_name'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
                'vendor_name'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
                'personal_mobile'=>'required|numeric',
                'vendor_mobile'=>'required|numeric',
                'vendor_email'=>'required|email|max:255',
                'vendor_address'=>'required',
                'vendor_city'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
                'vendor_state'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
                'vendor_country'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
                'vendor_pincode'=>'required|numeric',
            ], [
                'personal_name.required'=>'Name is required',
                'vendor_name.required'=>'Name is required',
                'vendor_name.regex'=>'Valid Name is required',
                'vendor_email.required'=>'Email is required',
                'vendor_email.email'=>'Valid email is required',
                'personal_mobile.required'=>'Mobile is required',
                'personal_mobile.numeric'=>'Valid Mobile is required',
                'vendor_mobile.required'=>'Mobile is required',
                'vendor_mobile.numeric'=>'Valid Mobile is required',
                'vendor_address.required'=>'Address is required',
                'vendor_city.required'=>'City is required',
                'vendor_city.regex'=>'Valid City is required',
                'vendor_state.required'=>'State is required',
                'vendor_state.regex'=>'Valid State is required',
                'vendor_country.required'=>'Country is required',
                'vendor_country.regex'=>'Valid Country is required',
                'vendor_pincode.required'=>'Pincode is required',
                'vendor_pincode.numeric'=>'Valid Pincode is required',
            ]);

            // update admin details to admins table
            Admin::where('id', Auth::guard('admin')->user()->id)->update([
                'name'=>$request->personal_name,
                'mobile'=>$request->personal_mobile,
                'email'=>$request->personal_email,
            ]);

            // update vendor details to vendors table
            Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update([
                'name'=>$request->vendor_name,
                'address'=>$request->vendor_address,
                'city'=>$request->vendor_city,
                'state'=>$request->vendor_state,
                'country'=>$request->vendor_country,
                'pincode'=>$request->vendor_pincode,
                'mobile'=>$request->vendor_mobile,
                'email'=>$request->vendor_email
            ]);

            return redirect()->back()->with('success_message', 'Vendor details updated successfully');
        }
    }

    public function updateVendorBusiness(Request $request)
    {
        $dataVendorBusiness = VendorsBusinessDetail::where('id', Auth::guard('admin')->user()->vendor_id)->first();

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'shop_name'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
                'shop_address'=>'required',
                'shop_city'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
                'shop_state'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
                'shop_country'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
                'shop_pincode'=>'required|numeric',
                'shop_mobile'=>'required',
                'shop_email'=>'required|email|max:255',
                'shop_website'=>'nullable|url',
                'address_proof'=>'required',
                'address_proof_image'=>'mimes:JPG,jpeg,jpg,png,gif',
                'business_license_number'=>'required',
                'gst_number'=>'required',
                'pan_number'=>'required',
            ], [
                'shop_name.required'=>'Shop Name is required',
                'shop_name.regex'=>'Valid Shop Name is required',
                'shop_address.required'=>'Shop Address is required',
                'shop_city.required'=>'Shop City is required',
                'shop_city.regex'=>'Valid Shop City is required',
                'shop_state.required'=>'Shop State is required',
                'shop_state.regex'=>'Valid Shop State is required',
                'shop_country.required'=>'Shop Country is required',
                'shop_country.regex'=>'Valid Shop Country is required',
                'shop_pincode.required'=>'Shop Pincode is required',
                'shop_pincode.numeric'=>'Valid Shop Pincode is required',
                'shop_mobile.required'=>'Shop Mobile is required',
                'shop_email.required'=>'Shop Email is required',
                'shop_email.email'=>'Valid Shop Email is required',
                'shop_website.url'=>'Valid Shop Website is required',
                'address_proof.required'=>'Address Proof is required',
                'address_proof_image.mimes'=>'Valid Address Proof Image is required (jpeg, jpg, png, gif)',
                'business_license_number.required'=>'Business License Number is required',
                'gst_number.required'=>'GST Number is required',
                'pan_number.required'=>'PAN Number is required',
            ]);

            // upload address proof image
            if ($request->hasFile('address_proof_image')) {
                $file = $request->file('address_proof_image');
                if (!is_null($file)) {
                    File::delete(public_path('/vendor/photo/'. $dataVendorBusiness->address_proof_image));
                    $imageName = 'address_proof_' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('/vendor/photo'), $imageName);
                }
            } elseif (!empty($request['current_image'])) {
                $imageName = $request['current_image'];
            } else {
                $imageName = "";
            }

            // update vendor business details to vendors_business_details table
            \App\Models\VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([
                'shop_name'=>$request->shop_name,
                'shop_address'=>$request->shop_address,
                'shop_city'=>$request->shop_city,
                'shop_state'=>$request->shop_state,
                'shop_country'=>$request->shop_country,
                'shop_pincode'=>$request->shop_pincode,
                'shop_mobile'=>$request->shop_mobile,
                'shop_email'=>$request->shop_email,
                'shop_website'=>$request->shop_website,
                'address_proof'=>$request->address_proof,
                'address_proof_image'=>$imageName,
                'business_license_number'=>$request->business_license_number,
                'gst_number'=>$request->gst_number,
                'pan_number'=>$request->pan_number,
            ]);

            return redirect()->back()->with('success_message', 'Vendor Business details updated successfully');
        }
    }

    public function updateVendorBank(Request $request)
    {
        
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'account_holder_name'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
                'bank_name'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
                'account_number'=>'required|numeric',
                'bank_ifsc_code'=>'required|alpha_num|max:11',
            ], [
                'account_holder_name.required'=>'Account Holder Name is required',
                'account_holder_name.regex'=>'Valid Account Holder Name is required',
                'bank_name.required'=>'Bank Name is required',
                'bank_name.regex'=>'Valid Bank Name is required',
                'account_number.required'=>'Account Number is required',
                'account_number.numeric'=>'Valid Account Number is required',
                'bank_ifsc_code.required'=>'Bank IFSC Code is required',
                'bank_ifsc_code.alpha_num'=>'Valid Bank IFSC Code is required',
            ]);

            // update vendor bank details to vendors_bank_details table
            \App\Models\VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([
                'account_holder_name'=>$request->account_holder_name,
                'bank_name'=>$request->bank_name,
                'account_number'=>$request->account_number,
                'bank_ifsc_code'=>$request->bank_ifsc_code,
            ]);

            return redirect()->back()->with('success_message', 'Vendor Bank details updated successfully');
        }
    }

    public function viewAdmins($type = null)
    {
        $admins = Admin::query();
        // dd($admins);

        if (!empty($type)) {
            $admins = $admins->where('type', $type);
            $title = ucfirst($type);
        } else {
            $title = "All Admins, Subadmins & Vendors";
        }
        // dd($admins);

        $admins = $admins->get();

        return view('admin.admins.view_admin', compact('admins', 'title'));
    }

    public function showVendor($id)
    {
        $vendorDetails = Admin::with(['vendorPersonal', 'vendorBusiness', 'vendorBank'])->where('id', $id)->first();
        $vendorDetails = json_decode(json_encode($vendorDetails), true);
        // dd($vendorDetails);
        return view('admin.admins.show_vendor', compact('vendorDetails'));
    }

    public function updateAdminStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Admin::where('id', $data['admin_id'])->update(['status'=>$status]);
            return response()->json([
                'status'=>$status,
                'admin_id'=>$data['admin_id']   
            ]);
        }
    }
}
