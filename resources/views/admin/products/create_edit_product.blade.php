@extends('admin.layout.layout')

@section('content')

@include('admin.alert')

<h3 class="card-title">{{ $title }}</h3>
<form method="POST" @if(empty($product['id'])) action="{{ route('create.edit.product') }}" @else action="{{ route('create.edit.product', $product['id']) }}" @endif enctype="multipart/form-data">
    @csrf
    <div class="row mb-4">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Attributes</h4>
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" @if(!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}" @endif placeholder="Product Name">
                    </div>
                    <div class="form-group">
                        <label for="product_code">Product Code</label>
                        <input type="text" name="product_code" id="product_code" class="form-control" @if(!empty($product['product_code'])) value="{{ $product['product_code'] }}" @else value="{{ old('product_code') }}" @endif placeholder="Product Code">
                    </div>
                    <div class="form-group">
                        <label for="product_color">Product Color</label>
                        <input type="text" name="product_color" id="product_color" class="form-control" @if(!empty($product['product_color'])) value="{{ $product['product_color'] }}" @else value="{{ old('product_color') }}" @endif placeholder="Product Color">
                    </div>
                    <div class="form-group">
                        <label for="product_price">Product Price</label>
                        <input type="number" name="product_price" id="product_price" class="form-control" @if(!empty($product['product_price'])) value="{{ $product['product_price'] }}" @else value="{{ old('product_price') }}" @endif placeholder="Product Price">
                    </div>
                    <div class="form-group">
                        <label for="product_discount">Product Discount</label>
                        <input type="number" name="product_discount" id="product_discount" class="form-control" @if(!empty($product['product_discount'])) value="{{ $product['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif placeholder="Product Discount">
                    </div>
                    <div class="form-group">
                        <label for="product_weight">Product Weight</label>
                        <input type="number" name="product_weight" id="product_weight" class="form-control" @if(!empty($product['product_weight'])) value="{{ $product['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif placeholder="Product Weight">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Category</h4>
                    <div class="form-group">
                        <label for="category_id">Select Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select</option>
                            @foreach ($categories as $section)
                                <optgroup label="{{ $section['name'] }}"></optgroup>
                                @foreach ($section['categories'] as $category)
                                    <option value="{{ $category['id'] }}" @if(!empty($product['category_id'] == $category['id'])) selected @endif>&nbsp;&raquo;&nbsp;{{ $category['category_name'] }}</option>
                                    @foreach ($category['subcategories'] as $subcategory)
                                        <option value="{{ $subcategory['id'] }}" @if(!empty($product['category_id'] == $subcategory['id'])) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand_id">Select Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            <option value="">Select</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand['id'] }}" @if(!empty($product['brand_id'] == $brand['id'])) selected @endif>{{ $brand['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Media</h4>
                    <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <input type="file" name="product_image" id="product_image" class="form-control">
                        @if (!empty($product['product_image']))
                            <a href="{{ asset('/images/product_images/' . $product['product_image']) }}" target="_blank">See image</a>
                            <input type="hidden" name="current_product_image" id="current_product_image" value="{{ $product['product_image'] }}">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="product_video">Product Video</label>
                        <input type="file" name="product_video" id="product_video" class="form-control">
                        @if (!empty($product['product_video']))
                            <a href="{{ asset('/videos/product_videos/' . $product['product_video']) }}" target="_blank">See Video</a>
                            <input type="hidden" name="current_product_video" id="current_product_video" value="{{ $product['product_video'] }}">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product SEO</h4>
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control" @if(!empty($product['meta_title'])) value="{{ $product['meta_title'] }} @endif">
                    </div>
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" @if(!empty($product['meta_keywords'])) value="{{ $product['meta_keywords'] }} @endif">
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="10">@if(!empty($product['meta_description'])){{ $product['meta_description'] }}@endif</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Description</h4>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="9">@if(!empty($product['description'])){{ $product['description'] }}@endif</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-check">
                    <label for="is_featured" class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="Yes" @if (!empty($product['is_featured']) && $product['is_featured']=="Yes" ) checked @endif>
                        Featured Item
                    </label>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
    <a href="{{ route('products.view') }}" class="btn btn-light">Batal</a>
</form>

@endsection

@push('bottom-scripts')
    <script></script>
@endpush