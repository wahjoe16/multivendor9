@extends('admin.layout.layout')

@section('content')

@include('admin.alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Management Products</h4>
                <a href="{{ route('create.edit.product') }}" class="btn btn-success mb-3">Create New Product</a>
                <div class="table-responsive">
                    <table id="products" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Added By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_code }}</td>
                                <td>{{ $product->category->category_name }}</td>
                                <td>Rp. {{ $product->product_price }}</td>
                                <td>
                                    @if (!empty($product->product_image))
                                        <img src="{{ asset('/images/product_images/' . $product->product_image) }}" alt="{{ $product->product_name }}" style="width: 50px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    @if ($product->admin_type == "Vendor")
                                        <a href="{{ route('vendor.product.show', $product['vendor_id']) }}">{{ ucfirst($product->vendor->name) }}</a>
                                    @else
                                        {{ ucfirst($product->admin_type) }}
                                    @endif
                                </td>
                                <td>
                                    @if ($product->status == 1)
                                        <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)">
                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;" title="Active" status="Active"></i>
                                        </a>
                                    @else
                                        <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)">
                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;" title="Inactive" status="Inactive"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('product.show', ['id' => $product->id]) }}" title="Show Product"><i class="mdi mdi-eye" style="font-size: 25px;"></i></a>
                                    <a href="{{ route('create.edit.product', ['id' => $product->id]) }}" title="Edit Product"><i class="mdi mdi-pencil-box" style="font-size: 25px;"></i></a>
                                    <a href="javascript:void(0)" class="confirmDelete" module="product" moduleid="{{ $product->id }}" title="Delete Product"><i class="mdi mdi-file-excel-box" style="font-size: 25px;"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Added By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('bottom-scripts')
    {{-- DATA TABLE --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#products').DataTable();
        })
    </script>
    <script>
        $(document).ready(function(){
            $('.updateProductStatus').on('click', function(){
                var status = $(this).children("i").attr("status");
                var product_id = $(this).attr('product_id');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('update.product.status') }}",
                    data: {status: status, product_id:product_id, _token:'{{ csrf_token() }}'},
                    success: function(resp){
                        if (resp['status'] == 0) {
                            $("#product-"+product_id).html("<i class='mdi mdi-bookmark-outline' style='font-size: 25px;' title='Inactive' status='Inactive'></i>");
                        } else if(resp['status']==1) {
                            $("#product-"+product_id).html("<i class='mdi mdi-bookmark-check' style='font-size: 25px;' title='Active' status='Active'></i>");
                        }
                        
                    }, eror:function(){
                        alert("Error");
                    }
                    
                })
            })
        })
    </script>

    <script>
        $('.confirmDelete').on('click', function(){
            var module = $(this).attr('module');
            var moduleid = $(this).attr('moduleid');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    window.location.href = "/admin/delete/"+moduleid+"/"+module;
                }
            })
        })
    </script>
@endpush