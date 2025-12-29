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
                            <input type="hidden" id="url" value="{{ $url }}"> {{-- input hidden untuk mengirim url ke ajax --}}
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

                {{-- Products Listing --}}
                <div class="row filter-products">
                    @include('front.products.ajax_products_listing')
                </div>

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
    {{-- JavaScript for sorting products with AJAX --}}
    <script>
        // Function to get filter values
        function get_filter(class_name){
            var filter = [];
            $('.'+class_name+':checked').each(function(){
                filter.push($(this).val());
            });
            return filter;
        }
    </script>
@endpush