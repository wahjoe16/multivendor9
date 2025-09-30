@extends('admin.layout.layout')

@section('content')

@include('admin.alert')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Vendor Profile</h4>
                <form class="forms-sample" method="POST" action="{{ route('update.vendor.profile') }}" enctype="multipart/form-data">@csrf
                    <div class="form-group">
                        <label for="personal_name">Personal Name</label>
                        <input type="text" class="form-control" id="personal_name" name="personal_name" placeholder="Personal Name" value="{{ $dataAdmin['name'] }}">
                    </div>
                    <div class="form-group">
                        <label for="vendor_name">Vendor Name</label>
                        <input type="text" class="form-control" id="vendor_name" name="vendor_name" placeholder="Vendor Name" value="{{ $dataVendor['name'] }}">
                    </div>
                    <div class="form-group">
                        <label for="personal_email">Personal Email</label>
                        <input type="email" class="form-control" id="personal_email" name="personal_email" placeholder="Personal Email" value="{{ $dataAdmin['email'] }}">
                    </div>
                    <div class="form-group">
                        <label for="vendor_email">Vendor Email</label>
                        <input type="email" class="form-control" id="vendor_email" name="vendor_email" placeholder="Vendor Email" value="{{ $dataVendor['email'] }}">
                    </div>
                    <div class="form-group">
                        <label for="vendor_city">City</label>
                        <input type="text" class="form-control" id="vendor_city" name="vendor_city" placeholder="City" value="{{ $dataVendor['city'] }}">
                    </div>
                    <div class="form-group">
                        <label for="vendor_state">State</label>
                        <input type="text" class="form-control" id="vendor_state" name="vendor_state" placeholder="State" value="{{ $dataVendor['state'] }}">
                    </div>
                    <div class="form-group">
                        <label for="vendor_country">Country</label>
                        <select name="vendor_country" id="vendor_country" class="form-control">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->country_name }}" @if ($dataVendor['country'] == $country->country_name) selected @endif>{{ $country->country_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vendor_pincode">Pincode</label>
                        <input type="text" class="form-control" id="vendor_pincode" name="vendor_pincode" placeholder="Pincode" value="{{ $dataVendor['pincode'] }}">
                    </div>
                    <div class="form-group">
                        <label for="personal_mobile">Personal Mobile Phone</label>
                        <input type="text" class="form-control" id="personal_mobile" name="personal_mobile" placeholder="Personal Mobile Phone" value="{{ $dataAdmin['mobile'] }}">
                    </div>
                    <div class="form-group">
                        <label for="vendor_mobile">Vendor Mobile Phone</label>
                        <input type="text" class="form-control" id="vendor_mobile" name="vendor_mobile" placeholder="Vendor Mobile Phone" value="{{ $dataVendor['mobile'] }}">
                    </div>
                    <div class="form-group">
                        <label for="vendor_address">Vendor Address</label>
                        <input type="text" class="form-control" id="vendor_address" name="vendor_address" placeholder="Address" value="{{ $dataVendor['address'] }}">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('dashboard.admin') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Vendor Business Detail</h4>
                <form class="forms-sample" method="POST" action="{{ route('update.vendor.business') }}" enctype="multipart/form-data">@csrf
                    <div class="form-group">
                        <label for="shop_name">Shop Name</label>
                        <input type="text" class="form-control" id="shop_name" name="shop_name" placeholder="Shop Name" value="{{ $dataVendorBusiness['shop_name'] }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_address">Shop Address</label>
                        <input type="text" class="form-control" id="shop_address" name="shop_address" placeholder="Shop Address" value="{{ $dataVendorBusiness['shop_address'] }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_city">Shop City</label>
                        <input type="text" class="form-control" id="shop_city" name="shop_city" placeholder="Shop City" value="{{ $dataVendorBusiness['shop_city'] }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_state">Shop State</label>
                        <input type="text" class="form-control" id="shop_state" name="shop_state" placeholder="Shop State" value="{{ $dataVendorBusiness['shop_state'] }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_country">Shop Country</label>
                        <select name="shop_country" id="shop_country" class="form-control">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->country_name }}" @if ($country['country_name'] == $dataVendorBusiness['shop_country']) selected @endif>{{ $country->country_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="shop_pincode">Shop Pincode</label>
                        <input type="text" class="form-control" id="shop_pincode" name="shop_pincode" placeholder="Shop Pincode" value="{{ $dataVendorBusiness['shop_pincode'] }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_mobile">Shop Mobile</label>
                        <input type="text" class="form-control" id="shop_mobile" name="shop_mobile" placeholder="Shop Mobile" value="{{ $dataVendorBusiness['shop_mobile'] }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_website">Shop Website</label>
                        <input type="text" class="form-control" id="shop_website" name="shop_website" placeholder="Shop Website" value="{{ $dataVendorBusiness['shop_website'] }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_email">Shop Email</label>
                        <input type="email" class="form-control" id="shop_email" name="shop_email" placeholder="Shop Email" value="{{ $dataVendorBusiness['shop_email'] }}">
                    </div>
                    <div class="form-group">
                        <label for="address_proof">Address Proof</label>
                        <input type="text" class="form-control" id="address_proof" name="address_proof" placeholder="Address Proof" value="{{ $dataVendorBusiness['address_proof'] }}">
                    </div>
                    <div class="form-group">
                        <label for="business_license_number">Business License Number</label>
                        <input type="text" class="form-control" id="business_license_number" name="business_license_number" placeholder="Business License Number" value="{{ $dataVendorBusiness['business_license_number'] }}">
                    </div>
                    <div class="form-group">
                        <label for="gst_number">GST Number</label>
                        <input type="text" class="form-control" id="gst_number" name="gst_number" placeholder="GST Number" value="{{ $dataVendorBusiness['gst_number'] }}">
                    </div>
                    <div class="form-group">
                        <label for="pan_number">PAN Number</label>
                        <input type="text" class="form-control" id="pan_number" name="pan_number" placeholder="PAN Number" value="{{ $dataVendorBusiness['pan_number'] }}">
                    </div>
                    <div class="form-group">
                        <label for="address_proof_image">Address proof image</label>
                        <input type="file" class="form-control" id="address_proof_image" name="address_proof_image">
                        @if (!empty($dataVendorBusiness->address_proof_image))
                            <a target="_blank" href="{{ asset('/vendor/photo/'.$dataVendorBusiness->address_proof_image) }}">View Image</a>
                            <input type="hidden" name="current_image" value="{{ $dataVendorBusiness->address_proof_image }}">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('dashboard.admin') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Vendor Business Detail</h4>
                <form class="forms-sample" method="POST" action="{{ route('update.vendor.bank') }}" enctype="multipart/form-data">@csrf
                    <div class="form-group">
                        <label for="account_holder_name">Account Holder Name</label>
                        <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" placeholder="Account Holder Name" value="{{ $dataVendorBank['account_holder_name'] }}">
                    </div>
                    <div class="form-group">
                        <label for="bank_name">Bank Name</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name" value="{{ $dataVendorBank['bank_name'] }}">
                    </div>
                    <div class="form-group">
                        <label for="account_number">Account Number</label>
                        <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" value="{{ $dataVendorBank['account_number'] }}">
                    </div>
                    <div class="form-group">
                        <label for="bank_ifsc_code">Bank IFSC Code</label>
                        <input type="text" class="form-control" id="bank_ifsc_code" name="bank_ifsc_code" placeholder="Bank IFSC Code" value="{{ $dataVendorBank['bank_ifsc_code'] }}">
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('dashboard.admin') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection