@extends('admin.layout.layout')

@section('content')

<div class="row">
    <div class="col-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Personal Details
                </h4>
                <ul class="icon-data-list">
                    <li>
                        <div class="d-flex">
                            <img src="{{ asset('/user/photo/'. $vendorDetails['image']) }}" alt="" style="width: 140px; height: 140px; border-radius: 50%; object-fit: cover;">
                            <div>
                                <h4 class="text-info mb-1">{{ $vendorDetails['name'] }}</h4>
                                <i class="mdi mdi-eyedropper"></i>&nbsp;{{ $vendorDetails['type'] }}<br>
                                <i class="mdi mdi-email-outline"></i>&nbsp;{{ $vendorDetails['email'] }}<br>
                                <i class="mdi mdi-cellphone-iphone"></i>&nbsp;{{ $vendorDetails['mobile'] }}<br>
                                @if ($vendorDetails['status'] == 1)
                                    <small>Active</small>
                                @else
                                    <small>Inactive</small>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Bank Details
                </h4>
                <table class="table table-borderless report-table">
                    <tbody>
                        <tr>
                            <td class="text-muted">Account Holder Name</td>
                            <td>{{ $vendorDetails['vendor_bank']['account_holder_name'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Bank Name</td>
                            <td>{{ $vendorDetails['vendor_bank']['bank_name'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Account Number</td>
                            <td>{{ $vendorDetails['vendor_bank']['account_number'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Bank IFSC Code</td>
                            <td>{{ $vendorDetails['vendor_bank']['bank_ifsc_code'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Business Details
                </h4>
                <table class="table table-borderless report-table"> 
                    <tbody>
                        <tr>
                            <td class="text-muted">Shop Name</td>
                            <td>{{ $vendorDetails['vendor_business']['shop_name'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Address</td>
                            <td>{{ $vendorDetails['vendor_business']['shop_address'] }}</td>    
                        </tr>
                        <tr>
                            <td class="text-muted">Shop City</td>
                            <td>{{ $vendorDetails['vendor_business']['shop_city'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop State</td>
                            <td>{{ $vendorDetails['vendor_business']['shop_state'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Country</td>
                            <td>{{ $vendorDetails['vendor_business']['shop_country'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Pincode</td>
                            <td>{{ $vendorDetails['vendor_business']['shop_pincode'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Mobile</td>
                            <td>{{ $vendorDetails['vendor_business']['shop_mobile'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Email</td>
                            <td>{{ $vendorDetails['vendor_business']['shop_email'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Website</td>
                            <td>{{ $vendorDetails['vendor_business']['shop_website'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Address Proof</td>
                            <td>{{ $vendorDetails['vendor_business']['address_proof'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Business License Number</td>
                            <td>{{ $vendorDetails['vendor_business']['business_license_number'] }}</td> 
                        </tr>
                        <tr>
                            <td class="text-muted">GST Number</td>
                            <td>{{ $vendorDetails['vendor_business']['gst_number'] }}</td>  
                        </tr>
                        <tr>
                            <td class="text-muted">PAN Number</td>
                            <td>{{ $vendorDetails['vendor_business']['pan_number'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Vendor Details
                </h4>
                <table class="table table-borderless report-table">
                    <tbody>
                        <tr>
                            <td class="text-muted">Vendor Name</td>
                            <td>{{ $vendorDetails['vendor_personal']['name'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Address</td>
                            <td>{{ $vendorDetails['vendor_personal']['address'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor City</td>
                            <td>{{ $vendorDetails['vendor_personal']['city'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor State</td>
                            <td>{{ $vendorDetails['vendor_personal']['state'] }}</td>   
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Country</td>
                            <td>{{ $vendorDetails['vendor_personal']['country'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Pincode</td>
                            <td>{{ $vendorDetails['vendor_personal']['pincode'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Mobile</td>
                            <td>{{ $vendorDetails['vendor_personal']['mobile'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Email</td>
                            <td>{{ $vendorDetails['vendor_personal']['email'] }}</td>   
                        </tr>
                    </tbody>
                </table>
                <div class="py-3">
                    <h4 class="card-title">
                        Vendor Business Image
                    </h4>
                    <img src="{{ asset('/vendor/photo/' . $vendorDetails['vendor_business']['address_proof_image']) }}" alt="" width="400">
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection