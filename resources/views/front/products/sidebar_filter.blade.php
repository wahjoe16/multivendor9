<?php
    use App\Models\ProductsFilter;
    $productFilters = ProductsFilter::productFilters(); // memanggil function productFilters dari model ProductsFilter
?>


<div class="col-lg-3 col-md-4">
    <!-- Price Start -->
    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
    <div class="bg-light p-4 mb-30">
        <form>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                <input type="checkbox" class="custom-control-input" checked id="price-all">
                <label class="custom-control-label" for="price-all">All Price</label>
                <span class="badge border font-weight-normal">1000</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                <input type="checkbox" class="custom-control-input" id="price-1">
                <label class="custom-control-label" for="price-1">$0 - $100</label>
                <span class="badge border font-weight-normal">150</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                <input type="checkbox" class="custom-control-input" id="price-2">
                <label class="custom-control-label" for="price-2">$100 - $200</label>
                <span class="badge border font-weight-normal">295</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                <input type="checkbox" class="custom-control-input" id="price-3">
                <label class="custom-control-label" for="price-3">$200 - $300</label>
                <span class="badge border font-weight-normal">246</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                <input type="checkbox" class="custom-control-input" id="price-4">
                <label class="custom-control-label" for="price-4">$300 - $400</label>
                <span class="badge border font-weight-normal">145</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                <input type="checkbox" class="custom-control-input" id="price-5">
                <label class="custom-control-label" for="price-5">$400 - $500</label>
                <span class="badge border font-weight-normal">168</span>
            </div>
        </form>
    </div>
    <!-- Price End -->
    
    <!-- Filter Start -->
    @foreach ($productFilters as $filter)
        <?php
            // Cek apakah filter memiliki produk yang tersedia di kategori saat ini
            $filterAvailable = ProductsFilter::filterAvailable($filter['id'], $categoryDetails['categoryDetails']['id']);
        ?>
        <!-- Jika ada produk yang tersedia untuk filter ini, tampilkan filter beserta nilainya -->
        @if ($filterAvailable == "Yes")
            @if (count($filter['filter_values']) > 0)
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by {{ $filter['filter_name'] }}</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        @foreach ($filter['filter_values'] as $value)
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                {{-- Checkbox untuk filter berdasarkan filter column dan filter value --}}
                                <input type="checkbox" class="custom-control-input {{ $filter['filter_column'] }}" id="{{ $value['filter_value'] }}" name="{{ $filter['filter_column'] }}[]" value="{{ $value['filter_value'] }}">
                                <label class="custom-control-label" for="{{ $value['filter_value'] }}">{{ $value['filter_value'] }}</label>
                                <span class="badge border font-weight-normal">150</span>
                            </div>
                        @endforeach
                    </form>
                </div>
            @endif
        @endif
    @endforeach
    
    <!-- Filter End -->

    <!-- Size Start -->
    <?php
        $getsizes = ProductsFilter::getSizes($url); // memanggil function getSizes dari model ProductsFilter
    ?>
    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
    <div class="bg-light p-4 mb-30">
        <form>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                <input type="checkbox" class="custom-control-input" checked id="size-all">
                <label class="custom-control-label" for="size-all">All Size</label>
                <span class="badge border font-weight-normal">1000</span>
            </div>
            {{-- Loop through sizes and create checkboxes --}}
            @foreach ($getsizes as $key => $size)
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <input type="checkbox" class="custom-control-input size" name="size[]" id="size{{ $key }}" value="{{ $size }}">
                    <label class="custom-control-label" for="size{{ $key }}">{{ $size }}</label>
                    <span class="badge border font-weight-normal">150</span>
                </div>
            @endforeach
        </form>
    </div>
    <!-- Size End -->

    <!-- Color Start -->
    <?php
        $getcolors = ProductsFilter::getColors($url); // memanggil function getColors dari model ProductsFilter
    ?>
    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
    <div class="bg-light p-4 mb-30">
        <form>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                <input type="checkbox" class="custom-control-input" checked id="color-all">
                <label class="custom-control-label" for="color-all">All Color</label>
                <span class="badge border font-weight-normal">1000</span>
            </div>
            {{-- Loop through colors and create checkboxes --}}
            @foreach ($getcolors as $key => $color)
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <input type="checkbox" class="custom-control-input color" name="color[]" id="color{{ $key }}" value="{{ $color }}">
                    <label class="custom-control-label" for="color{{ $key }}">{{ $color }}</label>
                    <span class="badge border font-weight-normal">150</span>
                </div>
            @endforeach
        </form>
    </div>
    <!-- Color End -->
</div>