<?php
    use App\Models\Product;
?>

@foreach ($getVendorProducts as $gvp)
    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
        <div class="product-item bg-light mb-4">
            <div class="product-img position-relative overflow-hidden">
                <?php
                    $imagePath = '/images/product_images/' . $gvp['product_image'];
                ?>
                <a href="">
                    @if (!empty($gvp['product_image']) && file_exists(public_path($imagePath)))
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
                    <a class="btn btn-outline-dark btn-square" href="{{ route('product.detail', $gvp['id']) }}"><i class="fa fa-search"></i></a>
                </div>
            </div>
            <div class="text-center py-4">
                <a class="h6 text-decoration-none text-truncate" href="{{ route('product.detail', $gvp['id']) }}">{{ $gvp['product_name'] }}</a>
                <div class="d-flex align-items-center justify-content-center mt-2">
                    <?php
                        $discountedPrice = Product::getDiscountPrice($gvp['id']);
                    ?>
                    @if ($discountedPrice > 0)
                        <h5>${{ $discountedPrice }}</h5><h6 class="text-muted ml-2"><del>${{ $gvp['product_price'] }}</del></h6>
                    @else
                        <h5>${{ $gvp['product_price'] }}</h5>
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
                            <a class="breadcrumb-item text-dark" href="#" style="font-size: 10px;">{{ $gvp['product_code'] }}</a>
                            <a class="breadcrumb-item text-dark" href="#" style="font-size: 10px;">{{ $gvp['brand']['name'] }}</a>
                            {{-- menampilkan label "New" jika produk baru --}}
                            <?php $isProductNew = Product::isProductNew($gvp['id']); ?>
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