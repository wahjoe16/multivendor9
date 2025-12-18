<?php
    use App\Models\Product;
?>
@extends('front.layout.layout')

@section('content')

<!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    {!! $categoryDetails['brandcrumbs'] !!}
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        
        <!-- Shop Sidebar Start -->
        @include('front.products.sidebar_filter')
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                        <form name="sortProducts" id="sortProducts">
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sort" id="sort" class="form-control">
                                        <option value="">Sort By</option>
                                        <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort']=="product_latest") selected @endif>Latest</option>
                                        <option value="price_lowest" @if(isset($_GET['sort']) && $_GET['sort']=="price_lowest") selected @endif>Lowest Price</option>
                                        <option value="price_highest" @if(isset($_GET['sort']) && $_GET['sort']=="price_highest") selected @endif>Highest Price</option>
                                        <option value="name_asc" @if(isset($_GET['sort']) && $_GET['sort']=="name_asc") selected @endif>Name: A - Z</option>
                                        <option value="name_desc" @if(isset($_GET['sort']) && $_GET['sort']=="name_desc") selected @endif>Name: Z - A</option>
                                    </select>
                                    <select name="show" id="show-by" class="form-control ml-2">
                                        <option value="">Showing</option>
                                        <option>{{ count($categoryProducts) }}</option>
                                        <option>All</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @foreach ($categoryProducts as $cp)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <?php
                                    $imagePath = '/images/product_images/' . $cp['product_image'];
                                ?>
                                <a href="">
                                    @if (!empty($cp['product_image']) && file_exists(public_path($imagePath)))
                                        <img class="img-fluid w-100" src="{{ asset($imagePath) }}" alt="">
                                    @else
                                        <img class="img-fluid w-100" src="{{ asset('/images/product_images/no_image.png') }}" alt="">
                                    @endif
                                </a>
                                <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $cp['product_name'] }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <?php
                                        $discountedPrice = Product::getDiscountPrice($cp['id']);
                                    ?>
                                    @if ($discountedPrice > 0)
                                        <h5>${{ $discountedPrice }}</h5><h6 class="text-muted ml-2"><del>${{ $cp['product_price'] }}</del></h6>
                                    @else
                                        <h5>${{ $cp['product_price'] }}</h5>
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
                                            <a class="breadcrumb-item text-dark" href="#" style="font-size: 10px;">{{ $cp['product_code'] }}</a>
                                            <a class="breadcrumb-item text-dark" href="#" style="font-size: 10px;">{{ $cp['brand']['name'] }}</a>
                                            {{-- menampilkan label "New" jika produk baru --}}
                                            <?php $isProductNew = Product::isProductNew($cp['id']); ?>
                                            @if ($isProductNew == "Yes")
                                                <a class="breadcrumb-item text-dark" href="#" style="font-size: 10px;">New</a>
                                            @endif
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-12">
                    <nav>
                        <ul class="pagination justify-content-center">
                            @if (isset($_GET['sort']))
                                {{-- Pagination Links --}}
                                {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
                            @else
                                {{-- Pagination Links --}}
                                {{ $categoryProducts->links() }}
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

@endsection

@push('bottom_scripts')
    <script>
        $(document).ready(function(){
            // Sort products
            $('#sort').on('change', function(){
                // alert($(this).val());
                this.form.submit();
            });
        });
    </script>
@endpush