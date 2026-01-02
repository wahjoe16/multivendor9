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
                            <td>{{ $vendorDetails->vendorBank->account_holder_name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Bank Name</td>
                            <td>{{ $vendorDetails->vendorBank->bank_name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Account Number</td>
                            <td>{{ $vendorDetails->vendorBank->account_number ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Bank IFSC Code</td>
                            <td>{{ $vendorDetails->vendorBank->bank_ifsc_code ?? '' }}</td>
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
                            <td>{{ $vendorDetails->vendorBusiness->shop_name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Address</td>
                            <td>{{ $vendorDetails->vendorBusiness->shop_address ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop City</td>
                            <td>{{ $vendorDetails->vendorBusiness->shop_city ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop State</td>
                            <td>{{ $vendorDetails->vendorBusiness->shop_state ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Country</td>
                            <td>{{ $vendorDetails->vendorBusiness->shop_country ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Pincode</td>
                            <td>{{ $vendorDetails->vendorBusiness->shop_pincode ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Mobile</td>
                            <td>{{ $vendorDetails->vendorBusiness->shop_mobile ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Email</td>
                            <td>{{ $vendorDetails->vendorBusiness->shop_email ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Website</td>
                            <td>{{ $vendorDetails->vendorBusiness->shop_website ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Address Proof</td>
                            <td>{{ $vendorDetails->vendorBusiness->address_proof ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Business License Number</td>
                            <td>{{ $vendorDetails->vendorBusiness->business_license_number ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">GST Number</td>
                            <td>{{ $vendorDetails->vendorBusiness->gst_number ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">PAN Number</td>
                            <td>{{ $vendorDetails->vendorBusiness->pan_number ?? '' }}</td>
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
                            <td>{{ $vendorDetails->vendorPersonal->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Address</td>
                            <td>{{ $vendorDetails->vendorPersonal->address ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor City</td>
                            <td>{{ $vendorDetails->vendorPersonal->city ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor State</td>
                            <td>{{ $vendorDetails->vendorPersonal->state ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Country</td>
                            <td>{{ $vendorDetails->vendorPersonal->country ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Pincode</td>
                            <td>{{ $vendorDetails->vendorPersonal->pincode ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Mobile</td>
                            <td>{{ $vendorDetails->vendorPersonal->mobile ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Email</td>
                            <td>{{ $vendorDetails->vendorPersonal->email ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="py-3">
                    <h4 class="card-title">
                        Vendor Business Image
                    </h4>
                    @if (empty($vendorDetails->vendorBusiness->address_proof_image))
                        <h5 class="text-danger">No Image Found</h5>
                    @else
                    <img src="{{ asset('/vendor/photo/' . $vendorDetails->vendorBusiness->address_proof_image) }}" alt="" width="400">
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection