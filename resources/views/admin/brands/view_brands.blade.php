@extends('admin.layout.layout')

@push('top_css')
    
@endpush

@section('content')

@include('admin.alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Brands Management</h4>
                <a href="{{ route('create.edit.brand') }}" class="btn btn-success mb-2">Create New Brand</a>
                <div class="table-responsive">
                    <table id="brands" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $brand)
                            <tr>
                                <td>{{ $brand['name'] }}</td>
                                <td>
                                    @if ($brand['status'] == 1)
                                        <a class="updateBrandStatus" id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}" href="javascript:void(0)">
                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;" title="Active" status="Active"></i>
                                        </a>
                                    @else
                                        <a class="updateBrandStatus" id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}" href="javascript:void(0)">
                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;" title="Inactive" status="Inactive"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('create.edit.brand', $brand['id']) }}"><i class="mdi mdi-pencil-box" style="font-size: 25px;"></i></a>
                                    <a href="javascript:void(0)" class="confirmDelete" module="brand" moduleid="{{ $brand['id'] }}"><i class="mdi mdi-file-excel-box" style="font-size: 25px;"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        $(document).ready(function() {
            $('#brands').DataTable();
        });
    </script>
    <script>
        $(document).on('click', '.updateBrandStatus', function() {
            var status = $(this).children("i").attr("status");
            var brand_id = $(this).attr("brand_id");
            // alert(status);
            // alert(brand_id);
            $.ajax({
                type: 'post',
                url: '{{ route('update.brand.status') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status,
                    brand_id: brand_id
                },
                success: function(resp) {
                    // alert(resp['status']);
                    if (resp['status'] == 0) {
                        $("#brand-" + brand_id).html("<i class='mdi mdi-bookmark-outline' style='font-size: 25px;' title='Inactive' status='Inactive'></i>");
                    } else if (resp['status'] == 1) {
                        $("#brand-" + brand_id).html("<i class='mdi mdi-bookmark-check' style='font-size: 25px;' title='Active' status='Active'></i>");
                    }
                },
                error: function() {
                    alert("Error");
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.confirmDelete', function() {
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
                    window.location.href = "/admin/delete/" + moduleid + "/" + module;
                }
            })
        });
    </script>
@endpush