@extends('admin.layout.layout')

@section('content')

@include('admin.alert')
<h4 class="card-title">{{ $product->product_name }}</h4>
<form action="{{ route('imagesProduct.add', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <img src="{{ asset('/images/product_images/' . $product['product_image']) }}" alt="" style="width: 260px; height: 260px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless report-table">
                        <tbody>
                            <tr>
                                <td class="text-muted">Product Name</td>
                                <td>{{ $product['product_name'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Price</td>
                                <td>{{ $product['product_price'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Product Code</td>
                                <td>{{ $product['product_code'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Color</td>
                                <td>{{ $product['product_color'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="image">Multiple Image Product</label>
                        <input type="file" name="image[]" id="image" class="form-control" multiple>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<h4 class="card-title mt-5">{{ $product->product_name }}&nbsp;Images</h4>
<div class="row mb-4">
    @foreach ($productImage as $data => $value)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex">
                        <img src="{{ asset('/images/product_images/multiple/' . $value->image) }}" alt="" style="width: 260px; height: 260px;">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection