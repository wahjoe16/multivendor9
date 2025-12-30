<?php
    use App\Models\ProductsFilter;
    $productFilters = ProductsFilter::productFilters(); // memanggil function productFilters dari model ProductsFilter
?>


<div class="col-lg-3 col-md-4">
    <!-- Price Start -->
    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
    <div class="bg-light p-4 mb-30">
        <form>
            <?php
                // Harga bisa diambil dari database atau didefinisikan secara statis
                $price = array('0-100','100-200','200-400','400-700','700-1000');
            ?>
            @foreach ($price as $key => $p)
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <input type="checkbox" class="custom-control-input price" name="price[]" id="price{{ $key }}" value="{{ $p }}">
                    <label class="custom-control-label" for="price{{ $key }}">${{ str_replace('-', ' - $', $p) }}</label>
                </div>
            @endforeach
        </form>
    </div>
    <!-- Price End -->

    <!-- Brand Start -->
    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by brand</span></h5>
    <div class="bg-light p-4 mb-30">
        <form>
            <?php
                $getBrands = ProductsFilter::getBrands($url); // memanggil function getBrands dari model ProductsFilter
            ?>
            @foreach ($getBrands as $key => $brand)
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <input type="checkbox" class="custom-control-input brand" name="brand[]" id="brand{{ $key }}" value="{{ $brand['id'] }}">
                    <label class="custom-control-label" for="brand{{ $key }}">{{ $brand['name'] }}</label>
                </div>
            @endforeach
        </form>
    </div>
    <!-- Brand End -->
    
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
                                {{-- <span class="badge border font-weight-normal">150</span> --}}
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
            {{-- Loop through sizes and create checkboxes --}}
            @foreach ($getsizes as $key => $size)
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <input type="checkbox" class="custom-control-input size" name="size[]" id="size{{ $key }}" value="{{ $size }}">
                    <label class="custom-control-label" for="size{{ $key }}">{{ $size }}</label>
                    {{-- <span class="badge border font-weight-normal">150</span> --}}
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
            {{-- Loop through colors and create checkboxes --}}
            @foreach ($getcolors as $key => $color)
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <input type="checkbox" class="custom-control-input color" name="color[]" id="color{{ $key }}" value="{{ $color }}">
                    <label class="custom-control-label" for="color{{ $key }}">{{ $color }}</label>
                    {{-- <span class="badge border font-weight-normal">150</span> --}}
                </div>
            @endforeach
        </form>
    </div>
    <!-- Color End -->
</div>