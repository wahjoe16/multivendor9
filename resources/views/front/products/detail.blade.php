<?php
    use App\Models\Product;
    use App\Models\ProductsFilter;

    $productFilter = ProductsFilter::productFilters();
    // dd($productFilter);
?>

@extends('front.layout.layout')

@section('content')

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Product</a>
                    <span class="breadcrumb-item active">{{ $data->product_name }}</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                @if ($data->images && $data->images->count() > 0)
                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner bg-light">
                            @foreach ($data->images as $key => $image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img class="w-100 h-100" src="{{ asset('/images/product_images/multiple/' . $image->image) }}" alt="Product Image {{ $key+1 }}">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                @else
                    <p>No product images available.</p>
                @endif
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $data->product_name }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            @if (isset($data['vendor']))
                                <a href="{{ route('vendor.product.listing', $data['vendor']['id']) }}"><h5>{{ $data['vendor']['vendorsBusinessDetail']['shop_name'] }}</h5></a>
                            @endif
                        </div>
                    </div>
                    <?php
                        $getDiscount = Product::getDiscountPrice($data->id)
                    ?>
                    <span class="getAttributePrice">
                        @if ($getDiscount > 0)
                            <h3 class="font-weight-semi-bold mb-4">${{ $getDiscount }}</h3><h4 class="text-muted ml-2"><del>${{ $data->product_price }}</del></h4>
                        @else
                            <h3 class="font-weight-semi-bold mb-4">${{ $data->product_price }}</h3>
                        @endif
                    </span>
                    
                    <p class="mb-4">{{ $data->description }}</p>
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Sizes:</strong>
                        <form>
                            <select name="size" id="getPrice" product-id="{{ $data->id }}" class="form-control">
                                <option value="">Select Size</option>
                                @foreach ($data->attributes as $attribute)
                                    <option value="{{ $attribute->size }}">{{ $attribute->size }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Colors:</strong>
                        <form>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-1" name="color">
                                <label class="custom-control-label" for="color-1">Black</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-2" name="color">
                                <label class="custom-control-label" for="color-2">White</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-3" name="color">
                                <label class="custom-control-label" for="color-3">Red</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-4" name="color">
                                <label class="custom-control-label" for="color-4">Blue</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-5" name="color">
                                <label class="custom-control-label" for="color-5">Green</label>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Availability:</strong>
                        <?php $totalStock = $data->attributes->sum('stock'); ?>
                        @if ($totalStock > 0)
                            <label class="" for="color-1" style="color: green;">In Stock</label>
                        @else
                            <label class="" for="color-1" style="color: red;">Out Of Stock</label>
                        @endif
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Only:</strong>
                        <label class="" for="color-1" style="color: blue;">{{ $data->attributes->sum('stock') }} Left</label>
                    </div>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            
                            <input type="number" class="form-control bg-secondary border-0 text-center" value="1">
                            
                        </div>
                        <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Specifications</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Product Video</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4">Reviews (0)</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>{{ $data->description }}</p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <table>
                                @foreach ($productFilter as $filter)
                                    @if (isset($data['category_id']))
                                        <?php
                                            $filterAvailable = ProductsFilter::filterAvailable($filter['id'], $data['category_id']);
                                        ?>
                                        @if ($filterAvailable == "Yes")
                                            <tr class="list-group-item px-0">
                                                <td>{{ $filter['filter_name'] }}</td>
                                                <td>
                                                    @foreach ($filter['filter_values'] as $value)
                                                        @if (!empty($data[$filter['filter_column']]) && $value['filter_value'] == $data[$filter['filter_column']])
                                                            <strong>{{ ucwords($value['filter_value']) }}</strong>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <video width="850" controls>
                                <source src="{{ asset('/videos/product_videos/' . $data->product_video) }}" type="video/mp4">
                            </video>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">1 review for "Product Name"</h4>
                                    <div class="media mb-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Your Name *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    <!-- Similiar Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Similiar Products</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($similiarProducts as $key => $sp)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <?php
                                    $imagePath = '/images/product_images/' . $sp['product_image'];
                                ?>
                                @if (!empty($sp['product_image']) && file_exists(public_path($imagePath)))
                                    <img class="img-fluid w-100" src="{{ asset($imagePath) }}" alt="">
                                @else
                                    <img class="img-fluid w-100" src="{{ asset('/images/product_images/no_image.png') }}" alt="">
                                @endif
                                
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('product.detail', $sp['id']) }}"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="{{ route('product.detail', $sp['id']) }}">{{ $sp['product_name'] }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <?php
                                        $discountedPrice = Product::getDiscountPrice($sp['id'])
                                    ?>
                                    @if ($discountedPrice > 0)
                                        <h5>${{ $discountedPrice }}</h5><h6 class="text-muted ml-2"><del>${{ $sp['product_price'] }}</del></h6>
                                    @else
                                        <h5>${{ $sp['product_price'] }}</h5>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                                <div class="row px-xl-5">
                                    <div class="col-12">
                                        <nav class="breadcrumb bg-light mb-30">
                                            <a class="breadcrumb-item text-dark" href="#" style="font-size: 10px;">{{ $sp['product_code'] }}</a>
                                            <a class="breadcrumb-item text-dark" href="#" style="font-size: 10px;">{{ $sp['brand']['name'] }}</a>
                                            {{-- menampilkan label "New" jika produk baru --}}
                                            <?php $isProductNew = Product::isProductNew($sp['id']); ?>
                                            @if ($isProductNew == "Yes")
                                                <a class="breadcrumb-item text-dark" href="#" style="font-size: 10px;">New</a>
                                            @endif
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Similiar Products End -->

@endsection

@push('bottom_scripts')
    <script>
        $(document).ready(function() {
            $('#getPrice').change(function() {
                var size = $(this).val();
                var product_id = $(this).attr('product-id');
                // alert(size);
                $.ajax({
                    url: "{{ route('get.product.price') }}",
                    data: {
                        size:size, product_id:product_id, _token:'{{ csrf_token() }}'
                    },
                    type: 'post',
                    success: function(resp) {
                        // alert(resp['final_price']);
                        if (resp['discount'] > 0) {
                            $('.getAttributePrice').html("<h3 class='font-weight-semi-bold mb-4'>$"+resp['final_price']+"</h3><h4 class='text-muted ml-2'><del>$"+resp['product_price']+"</del></h4>")
                        } else {
                            $('.getAttributePrice').html("<h3 class='font-weight-semi-bold mb-4'>$"+resp['final_price']+"</h3>")
                        }
                    }, error: function() {
                        alert('Error');
                    }
                })
            })
        })
    </script>
@endpush