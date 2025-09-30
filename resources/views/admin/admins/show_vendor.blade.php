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
                            @if (empty($vendorDetails['vendor_bank']['account_holder_name']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_bank']['account_holder_name'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Bank Name</td>
                            @if (empty($vendorDetails['vendor_bank']['bank_name']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_bank']['bank_name'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Account Number</td>
                            @if (empty($vendorDetails['vendor_bank']['account_number']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_bank']['account_number'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Bank IFSC Code</td>
                            @if (empty($vendorDetails['vendor_bank']['bank_ifsc_code']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_bank']['bank_ifsc_code'] }}</td>
                            @endif
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
                            @if (empty($vendorDetails['vendor_business']['shop_name']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_business']['shop_name'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Address</td>
                            @if (empty($vendorDetails['vendor_business']['shop_address']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_business']['shop_address'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Shop City</td>
                            @if (empty($vendorDetails['vendor_business']['shop_city']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_business']['shop_city'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Shop State</td>
                            @if (empty($vendorDetails['vendor_business']['shop_state']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_business']['shop_state'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Country</td>
                            @if (empty($vendorDetails['vendor_business']['shop_country']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_business']['shop_country'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Pincode</td>
                            @if (empty($vendorDetails['vendor_business']['shop_pincode']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_business']['shop_pincode'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Mobile</td>
                            @if (empty($vendorDetails['vendor_business']['shop_mobile']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_business']['shop_mobile'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Email</td>
                            @if (empty($vendorDetails['vendor_business']['shop_email']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_business']['shop_email'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Shop Website</td>
                            @if (empty($vendorDetails['vendor_business']['shop_website']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_business']['shop_website'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Address Proof</td>
                            @if (empty($vendorDetails['vendor_business']['address_proof']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_business']['address_proof'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Business License Number</td>
                            @if (empty($vendorDetails['vendor_business']['business_license_number']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_business']['business_license_number'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">GST Number</td>
                            @if (empty($vendorDetails['vendor_business']['gst_number']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_business']['gst_number'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">PAN Number</td>
                            @if (empty($vendorDetails['vendor_business']['pan_number']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_business']['pan_number'] }}</td>
                            @endif
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
                            @if (empty($vendorDetails['vendor_personal']['name']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_personal']['name'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Address</td>
                            @if (empty($vendorDetails['vendor_personal']['address']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_personal']['address'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor City</td>
                            @if (empty($vendorDetails['vendor_personal']['city']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_personal']['city'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor State</td>
                            @if (empty($vendorDetails['vendor_personal']['state']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_personal']['state'] }}</td>
                            @endif  
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Country</td>
                            @if (empty($vendorDetails['vendor_personal']['country']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_personal']['country'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Pincode</td>
                            @if (empty($vendorDetails['vendor_personal']['pincode']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_personal']['pincode'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Mobile</td>
                            @if (empty($vendorDetails['vendor_personal']['mobile']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_personal']['mobile'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Email</td>
                            @if (empty($vendorDetails['vendor_personal']['email']))
                                <td>--</td>
                            @else
                                <td>{{ $vendorDetails['vendor_personal']['email'] }}</td>
                            @endif  
                        </tr>
                    </tbody>
                </table>
                <div class="py-3">
                    <h4 class="card-title">
                        Vendor Business Image
                    </h4>
                    @if (empty($vendorDetails['vendor_business']['address_proof_image']))
                        <h5 class="text-danger">No Image Found</h5>
                    @else
                    <img src="{{ asset('/vendor/photo/' . $vendorDetails['vendor_business']['address_proof_image']) }}" alt="" width="400">
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection