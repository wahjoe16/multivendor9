@extends('admin.layout.layout')

@section('content')

@include('admin.alert')
<h4 class="card-title">{{ $product->product_name }}</h4>
<form action="{{ route('attributesProduct.add', $product->id) }}" method="POST">
    @csrf
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <img src="{{ asset('/images/product_images/' . $product['product_image']) }}" alt="" style="width: 260px; height: 260px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless report-table">
                        <tbody>
                            <tr>
                                <td class="text-muted">Product Name</td>
                                <td>{{ $product['product_name'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Price</td>
                                <td>{{ $product['product_price'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Product Code</td>
                                <td>{{ $product['product_code'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Color</td>
                                <td>{{ $product['product_color'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Attributes Product</h4>
                    <div class="form-group">
                        <div class="field_wrapper">
                            <div>
                                <input type="text" name="size[]" placeholder="Size" style="width: 200px;" required>
                                <input type="text" name="sku[]" placeholder="Sku" style="width: 200px;" required>
                                <input type="text" name="price[]" placeholder="Price" style="width: 200px;" required>
                                <input type="text" name="stock[]" placeholder="Stock" style="width: 200px;" required>
                                <a href="javascript:void(0)" class="add_button" title="Add Field"><i class="mdi mdi-plus-circle" style="font-size: 25px;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success btn-sm"><i class="mdi mdi-content-save"></i>&nbsp;Save</button>
    <a href="{{ route('products.view') }}" class="btn btn-light btn-sm">Cancel</a>
</form>

<form action="{{ route('attributesProduct.edit', $product->id) }}" method="POST">
    @csrf
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Product Attributes</h4>
                    <div class="table-responsive">
                        <table id="product_attributes" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product['attributes'] as $pa)
                                    <input type="text" style="display: none;" name="attributeId[]" value="{{ $pa['id'] }}">
                                    <tr>
                                        <td>{{ $pa['size'] }}</td>    
                                        <td>{{ $pa['sku'] }}</td>
                                        <td><input type="number" name="price[]" class="form-control" value="{{ $pa['price'] }}" required></td>
                                        <td><input type="number" name="stock[]" class="form-control" value="{{ $pa['stock'] }}" required></td>
                                        <td>
                                            @if ($pa['status']==1)
                                                <a href="javascript:void(0)" class="updateAttributeStatus" id="attribute-{{ $pa['id'] }}" attribute_id="{{ $pa['id'] }}">
                                                    <i class="mdi mdi-bookmark-check" style="font-size:25px" status="Active"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" class="updateAttributeStatus" id="attribute-{{ $pa['id'] }}" attribute_id="{{ $pa['id'] }}">
                                                    <i class="mdi mdi-bookmark-outline" style="font-size:25px" status="Inactive"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>    
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('bottom-scripts')
    <script>
        $(document).ready(function(){
            var maxfield = 10;
            var addbutton = $('.add_button');
            var wrapper = $('.field_wrapper');
            var fieldHtml = '<div><div style="height: 10px;"></div><input type="text" name="size[]" placeholder="Size" style="width: 200px;"/>&nbsp;<input type="text" name="sku[]" placeholder="SKU" style="width: 200px;"/>&nbsp;<input type="text" name="price[]" placeholder="Price" style="width: 200px;"/>&nbsp;<input type="text" name="stock[]" placeholder="Stock" style="width: 200px;"/>&nbsp;<a href="javascript:void(0);" class="remove_button"><i class="mdi mdi-minus-circle"></i></a></div>';
            var x = 1;
            
            $(addbutton).click(function(){
                if (x < maxfield) {
                    x++;
                    $(wrapper).append(fieldHtml);
                }
            })

            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        })
    </script>

    <script>
        // update Attribute Status
        $(document).on("click", ".updateAttributeStatus", function(){
            // alert("test");
            var status = $(this).children("i").attr("status");
            var attribute_id = $(this).attr("attribute_id");
            // alert(status);
            $.ajax({
                type: "post",
                url: "{{ route('updateAttributeStatus') }}",
                data: {status:status, attribute_id:attribute_id, _token:'{{ csrf_token() }}'},
                success: function(resp){
                    // alert(resp);
                    if (resp['status']==0) {
                        $("#attribute-"+attribute_id).html("<i class='mdi mdi-bookmark-outline' style='font-size:25px' status='Inactive'></i>");
                    }else if (resp['status']==1) {
                        $("#attribute-"+attribute_id).html("<i class='mdi mdi-bookmark-check' style='font-size:25px' status='Active'></i>");
                    }
                }, error: function(){
                    alert("Error");
                }
            })
        });
    </script>
@endpush