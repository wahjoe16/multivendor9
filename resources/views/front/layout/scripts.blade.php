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
            var sort = $('#sort').val();
            var url = $('#url').val();
            // var fabric = get_filter('fabric'); // ambil nilai filter fabric
            // alert(url); return false;

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
    });

    // Filter by fabric
    @foreach ($productFilters as $filter)
        $('.{{ $filter["filter_column"] }}').on('click', function() {
            var url = $('#url').val();
            var sort = $('#sort option:selected').val();

            @foreach ($productFilters as $filters)
                var {{ $filters["filter_column"] }} = get_filter('{{ $filters["filter_column"] }}');
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
                    sort: sort, {{ $filter["filter_column"] }}: {{ $filter["filter_column"] }}, url: url, _token: '{{ csrf_token() }}'
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
    
</script>