@extends('admin.layout.layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Details Vendor</h4>
                <table class="table table-borderless report-table">
                    <tbody>
                        <tr>
                            <td class="text-muted">Vendor Name</td>
                            <td>{{ $dataVendor['name'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Address</td>
                            <td>{{ $dataVendor['address'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">City</td>
                            <td>{{ $dataVendor['city'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">State</td>
                            <td>{{ $dataVendor['state'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Country</td>
                            <td>{{ $dataVendor['country'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Pincode</td>
                            <td>{{ $dataVendor['pincode'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td>{{ $dataVendor['email'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Mobile</td>
                            <td>{{ $dataVendor['mobile'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection