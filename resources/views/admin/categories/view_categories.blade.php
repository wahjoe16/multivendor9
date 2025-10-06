@extends('admin.layout.layout')

@push('top_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap4.css">
@endpush

@section('content')

@include('admin.alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Categories</h4>
                <a href="{{ route('create.edit.category') }}" class="btn btn-sm btn-success">Create New Category</a>
                <div class="table-responsive pt-3">
                    <table id="categories" class="table table-striped">
                        <thead>
                            <tr>
                                <th> Name </th>
                                <th> Section </th>
                                <th> Parent Category </th>
                                <th> URL </th>
                                <th> Status </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $category)
                            <tr>
                                <td> {{ $category->category_name }} </td>
                                <td> {{ $category->section->name }} </td>
                                <td> {{ !empty($category->parentcategory->category_name) ? $category->parentcategory->category_name : 'Main Category' }} </td>
                                <td> {{ $category->url }} </td>
                                <td> 
                                    @if($category->status==1)
                                        <a class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}" href="javascript:void(0)">
                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;" title="Active" status="Active"></i>
                                        </a>
                                    @else
                                        <a class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}" href="javascript:void(0)">
                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;" title="Inactive" status="Inactive"></i>
                                        </a>
                                    @endif
                                </td>
                                <td> 
                                    <a href="{{ route('create.edit.category', $category['id']) }}"><i class="mdi mdi-pencil-box" style="font-size: 25px;"></i></a>
                                    &nbsp;&nbsp;
                                    <a href="javascript:void(0)" class="confirmDelete" module="category" moduleid="{{ $category->id }}" module_name="{{ $category->category_name }}"><i class="mdi mdi-file-excel-box" style="font-size: 25px;"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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
        $(document).ready(function () {
            $('#categories').DataTable();
        });
    </script>

    {{-- UPDATE SECTION STATUS --}}
    <script>
        $(document).on('click', '.updateCategoryStatus', function(){
            var status = $(this).children("i").attr("status");
            var category_id = $(this).attr("category_id");
            // alert(status);
            // alert(category_id);
            $.ajax({
                type: 'post',
                url: `{{ route('update.category.status') }}`,
                data: {status:status, category_id:category_id, _token:'{{ csrf_token() }}'},
                success:function(resp){
                    // alert(resp['status']);
                    if(resp['status']==0){
                        $("#category-"+category_id).html("<i class='mdi mdi-bookmark-outline' style='font-size: 25px;' title='Inactive' status='Inactive'></i>");
                    }else if(resp['status']==1){
                        $("#category-"+category_id).html("<i class='mdi mdi-bookmark-check' style='font-size: 25px;' title='Active' status='Active'></i>");
                    }
                },error:function(){
                    alert("Error");
                }
            });
        });
    </script>

    {{-- SWEET ALERT DELETE --}}
    <script>
        $('.confirmDelete').click(function(){
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
        });
    </script>
    
@endpush