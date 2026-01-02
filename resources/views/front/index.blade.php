<?php
    use App\Models\Product;
    use App\Models\Category;
?>
@extends('front.layout.layout')

@section('content')

    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($banner as $key => $b)
                            <li data-target="#header-carousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($banner as $key => $b)
                            <div class="carousel-item position-relative {{ $key == 0 ? 'active' : '' }} " style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="{{ url('/images/banners/' . $b['image']) }}" style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{ $b['title'] }}</h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">{{ $b['subtitle'] }}</p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="{{ $b['link'] }}">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="{{ url('/front/img/offer-1.jpg') }}" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="{{ url('/front/img/offer-2.jpg') }}" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
        <div class="row px-xl-5 pb-3">
            @foreach ($gridCategory as $gc)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <a class="text-decoration-none" href="">
                        <div class="cat-item d-flex align-items-center mb-4">
                            <div class="overflow-hidden" style="width: 100px; height: 100px;">
                                <img class="img-fluid" src="{{ url('/images/category_images/' . $gc['category_image']) }}" alt="">
                            </div>
                            <div class="flex-fill pl-3">
                                <h6>{{ $gc['category_name'] }}</h6>
                                <?php
                                    //$qtyProduct = Category::getCategoryProductsCount($gc['id']);
                                    // dd($qtyProduct);
                                ?>
                                <small class="text-body">100</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Categories End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Discounted Products</span></h2>
        <div class="row px-xl-5">
            @foreach ($discountedProducts as $key => $dp)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <?php
                                $productImagepath = '/images/product_images/' . $dp['product_image'];
                            ?>
                            <a href="{{ url('product/' . $dp['id']) }}">
                                @if (!empty($dp['product_image']) || file_exist($productImagepath))
                                    <img class="img-fluid w-100" src="{{ url($productImagepath) }}" alt="">
                                @else
                                    <img class="img-fluid w-100" src="{{ url('/images/product_images/no-image.png') }}" alt="">
                                @endif
                            </a>
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{ route('product.detail', $dp['id']) }}"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="{{ route('product.detail', $dp['id']) }}">{{ $dp['product_name'] }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <?php
                                    $discountedPrice = Product::getDiscountPrice($dp['id']);
                                ?>
                                @if ($discountedPrice > 0)
                                    <h5>${{ $discountedPrice }}</h5><h6 class="text-muted ml-2"><del>${{ $dp['product_price'] }}</del></h6>
                                @else
                                    <h5>${{ $dp['product_price'] }}</h5>
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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->


    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="{{ url('/front/img/offer-1.jpg') }}" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="{{ url('/front/img/offer-2.jpg') }}" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Products</span></h2>
        <div class="row px-xl-5">
            @foreach ($recentProducts as $rp)
                <?php
                    $productImagepath = '/images/product_images/' . $rp['product_image'];
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <a href="{{ url('product/' . $rp['id']) }}">
                                @if (!empty($rp['product_image']) || file_exist($productImagepath))
                                    <img class="img-fluid w-100" src="{{ url($productImagepath) }}" alt="">
                                @else
                                    <img class="img-fluid w-100" src="{{ url('/images/product_images/no-image.png') }}" alt="">
                                @endif
                            </a>
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{ route('product.detail', $rp['id']) }}"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="{{ route('product.detail', $rp['id']) }}">{{ $rp['product_name'] }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <?php
                                    $discountedPrice = Product::getDiscountPrice($rp['id']);
                                ?>
                                @if ($discountedPrice > 0)
                                    <h5>${{ $discountedPrice }}</h5><h6 class="text-muted ml-2"><del>${{ $rp['product_price'] }}</del></h6>
                                @else
                                    <h5>${{ $rp['product_price'] }}</h5>
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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="bg-light p-4">
                        <img src="{{ url('/front/img/vendor-1.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="{{ url('/front/img/vendor-2.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="{{ url('/front/img/vendor-3.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="{{ url('/front/img/vendor-4.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="{{ url('/front/img/vendor-5.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="{{ url('/front/img/vendor-6.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="{{ url('/front/img/vendor-7.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="{{ url('/front/img/vendor-8.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->

@endsection
