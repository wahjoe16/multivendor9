@extends('admin.layout.layout')

@section('content')

<h4 class="card-title">Details Product</h4>
<div class="row mb-4">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <img src="{{ asset('/images/product_images/' . $data['product_image']) }}" alt="" style="width: 290px; height: 290px;">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Category Product</h4>
                <table class="table table-borderless report-table">
                    <tbody>
                        <tr>
                            <td class="text-muted">Section</td>
                            <td>{{ $data['section']['name'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Category</td>
                            <td>{{ $data['category']['category_name'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Brand</td>
                            <td>{{ $data['brand']['name'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Product Code</td>
                            <td>{{ $data['product_code'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Product Color</td>
                            <td>{{ $data['product_color'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Product Price</h4>
                <table class="table table-borderless report-table">
                    <tbody>
                        <tr>
                            <td class="text-muted">Price</td>
                            <td>{{ $data['product_price'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Discount</td>
                            <td>{{ $data['product_discount'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Weight</td>
                            <td>{{ $data['product_weight'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Name</td>
                            <td>{{ $data['vendor']['name'] }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor Type</td>
                            <td>{{ $data['admin_type'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Product SEO</h4>
                <table class="table table-borderless report-table">
                    <tr>
                        <td class="text-muted">Meta Tile</td>
                        <td>{{ $data['meta_title'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Meta Keywords</td>
                        <td>{{ $data['meta_keywords'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Meta Descriptions</td>
                        <td>{{ $data['meta_description'] }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Product Description</h4>
                <p>{{ $data['description'] }}</p>
            </div>
        </div>
    </div>
</div>

@endsection