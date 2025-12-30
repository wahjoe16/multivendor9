<?php
    use App\Models\ProductsFilter;
    $productFilters = ProductsFilter::productFilters(); // memanggil function productFilters dari model ProductsFilter
?>

{{-- Your global scripts can go here --}}
<script>
    // JavaScript for sorting products with AJAX 
    $(document).ready(function(){
        // Sort products
        $('#sort').on('change', function(){
            // alert($(this).val());
            // this.form.submit();
            var sort = $('#sort').val(); // ambil nilai sorting
            var url = $('#url').val(); // ambil url saat ini
            var size = get_filter('size'); // ambil nilai filter size
            var color = get_filter('color'); // ambil nilai filter color
            var price = get_filter('price'); // ambil nilai filter price
            var brand = get_filter('brand'); // ambil nilai filter brand

            // var fabric = get_filter('fabric'); // ambil nilai filter fabric
            // alert(url); return false;

            // Get all dynamic filter columns
            @foreach ($productFilters as $filters)
                var {{ $filters["filter_column"] }} = get_filter('{{ $filters["filter_column"] }}'); // ambil nilai filter dynamic
            @endforeach

            // AJAX request
            $.ajax({
                url: url,
                method: 'Post',
                data: {
                    sort: sort, 
                    url: url,
                    size: size,
                    color: color, 
                    price: price,
                    brand: brand,
                    // fabric:fabric, 
                    @foreach ($productFilters as $filters)
                        {{ $filters["filter_column"] }}: {{ $filters["filter_column"] }},
                    @endforeach
                    _token: '{{ csrf_token() }}'
                }, // kirim data fabric juga
                success: function (data) {
                    // alert(response);
                    $('.filter-products').html(data);
                }, error: function () {
                    alert("Error");
                }
            })
        });

        // Filter By Size
        $('.size').on('change', function(){ // ketika ada perubahan pada checkbox size
            // alert($(this).val());
            // this.form.submit();
            var size = get_filter('size'); // ambil nilai filter size
            var sort = $('#sort').val(); // ambil nilai sorting
            var url = $('#url').val(); // ambil url saat ini
            var price = get_filter('price'); // ambil price saat ini
            var color = get_filter('color'); // ambil nilai filter color
            var brand = get_filter('brand'); // ambil nilai filter brand

            // var fabric = get_filter('fabric'); // ambil nilai filter fabric
            // alert(url); return false;

            // Get all dynamic filter columns
            @foreach ($productFilters as $filters)
                var {{ $filters["filter_column"] }} = get_filter('{{ $filters["filter_column"] }}');
            @endforeach

            // AJAX request
            $.ajax({
                url: url,
                method: 'Post',
                data: {
                    sort: sort, 
                    url: url, 
                    size: size,
                    color: color,
                    price: price,
                    brand: brand,
                    @foreach ($productFilters as $filters)
                        {{ $filters["filter_column"] }} : {{ $filters["filter_column"] }},
                    @endforeach
                    _token: '{{ csrf_token() }}'
                }, // kirim data fabric juga
                success: function (data) {
                    // alert(response);
                    $('.filter-products').html(data);
                }, error: function () {
                    alert("Error");
                }
            })
        });

        // Filter By Color
        $('.color').on('change', function(){ // ketika ada perubahan pada checkbox color
            // alert($(this).val());
            // this.form.submit();
            var color = get_filter('color'); // ambil nilai filter color
            var sort = $('#sort').val(); // ambil nilai sorting
            var url = $('#url').val(); // ambil url saat ini
            var size = get_filter('size'); // ambil nilai filter size
            var price = get_filter('price'); // ambil nilai filter price
            var brand = get_filter('brand'); // ambil nilai filter brand
            // var fabric = get_filter('fabric'); // ambil nilai filter fabric
            // alert(url); return false;

            // Get all dynamic filter columns
            @foreach ($productFilters as $filters)
                var {{ $filters["filter_column"] }} = get_filter('{{ $filters["filter_column"] }}');
            @endforeach

            // AJAX request
            $.ajax({
                url: url,
                method: 'Post',
                data: {
                    size: size,
                    sort: sort, 
                    url: url, 
                    color: color,
                    price: price,
                    brand: brand,
                    @foreach ($productFilters as $filters)
                        {{ $filters["filter_column"] }} : {{ $filters["filter_column"] }},
                    @endforeach
                    _token: '{{ csrf_token() }}'
                }, // kirim data fabric juga
                success: function (data) {
                    // alert(response);
                    $('.filter-products').html(data);
                }, error: function () {
                    alert("Error");
                }
            })
        });

        // Filter By Price
        $('.price').on('change', function(){ // ketika ada perubahan pada checkbox price
            // alert($(this).val());
            // this.form.submit();
            var price = get_filter('price'); // ambil nilai filter price
            var color = get_filter('color'); // ambil nilai filter color
            var sort = $('#sort').val(); // ambil nilai sorting
            var url = $('#url').val(); // ambil url saat ini
            var size = get_filter('size'); // ambil nilai filter size
            var brand = get_filter('brand'); // ambil nilai filter brand

            // var fabric = get_filter('fabric'); // ambil nilai filter fabric
            // alert(url); return false;

            // Get all dynamic filter columns
            @foreach ($productFilters as $filters)
                var {{ $filters["filter_column"] }} = get_filter('{{ $filters["filter_column"] }}');
            @endforeach

            // AJAX request
            $.ajax({
                url: url,
                method: 'Post',
                data: {
                    price: price,
                    size: size,
                    sort: sort, 
                    url: url, 
                    color: color,
                    brand: brand,
                    @foreach ($productFilters as $filters)
                        {{ $filters["filter_column"] }} : {{ $filters["filter_column"] }},
                    @endforeach
                    _token: '{{ csrf_token() }}'
                }, // kirim data fabric juga
                success: function (data) {
                    // alert(response);
                    $('.filter-products').html(data);
                }, error: function () {
                    alert("Error");
                }
            })
        });

        // Filter By Brand
        $('.brand').on('change', function(){ // ketika ada perubahan pada checkbox brand
            // alert($(this).val());
            // this.form.submit();
            var brand = get_filter('brand'); // ambil nilai filter brand
            var price = get_filter('price'); // ambil nilai filter price
            var color = get_filter('color'); // ambil nilai filter color
            var sort = $('#sort').val(); // ambil nilai sorting
            var url = $('#url').val(); // ambil url saat ini
            var size = get_filter('size'); // ambil nilai filter size

            // var fabric = get_filter('fabric'); // ambil nilai filter fabric
            // alert(url); return false;

            // Get all dynamic filter columns
            @foreach ($productFilters as $filters)
                var {{ $filters["filter_column"] }} = get_filter('{{ $filters["filter_column"] }}');
            @endforeach

            // AJAX request
            $.ajax({
                url: url,
                method: 'Post',
                data: {
                    brand: brand,
                    price: price,
                    size: size,
                    sort: sort, 
                    url: url, 
                    color: color,
                    @foreach ($productFilters as $filters)
                        {{ $filters["filter_column"] }} : {{ $filters["filter_column"] }},
                    @endforeach
                    _token: '{{ csrf_token() }}'
                }, // kirim data fabric juga
                success: function (data) {
                    // alert(response);
                    $('.filter-products').html(data);
                }, error: function () {
                    alert("Error");
                }
            })
        });

        // Filter by dinamic filter columns
        @foreach ($productFilters as $filter)
            $('.{{ $filter["filter_column"] }}').on('click', function() {
                var url = $('#url').val(); // ambil url saat ini
                var sort = $('#sort option:selected').val(); // ambil nilai sorting
                var size = get_filter('size'); // ambil nilai filter size
                var color = get_filter('color'); // ambil nilai filter color
                var price = get_filter('price'); // ambil nilai filter price
                var brand = get_filter('brand'); // ambil nilai filter brand

                // Get all dynamic filter columns
                @foreach ($productFilters as $filters)
                    var {{ $filters["filter_column"] }} = get_filter('{{ $filters["filter_column"] }}'); // ambil nilai filter dynamic
                    // alert({{ $filter["filter_column"] }}); return false;
                @endforeach
                

                // AJAX request
                $.ajax({
                    url: url,
                    method: 'Post',
                    data: {
                        @foreach ($productFilters as $filters)
                            {{ $filters["filter_column"] }}: {{ $filters["filter_column"] }},
                        @endforeach
                        sort: sort,
                        url: url, 
                        size: size,
                        color: color, 
                        price: price,
                        brand: brand,
                        {{ $filter["filter_column"] }}: {{ $filter["filter_column"] }}, 
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        // alert(response);
                        $('.filter-products').html(data);
                    }, error: function () {
                        alert("Error");
                    }
                })
            })
        @endforeach

    });

</script>