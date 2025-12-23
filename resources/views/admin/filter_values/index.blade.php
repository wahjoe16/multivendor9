<?php use App\Models\ProductsFilter; ?>

@extends('admin.layout.layout')

@push('top_css')
    
@endpush

@section('content')

@include('admin.alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filter Values Management</h4>
                <a href="{{ route('create.edit.filter.value') }}" class="btn btn-success mb-2">Create New Filter Value</a>
                <div class="table-responsive">
                    <table id="filter_values" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Filter ID</th>
                                <th>Filter Name</th>
                                <th>Filter Value</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filterValues as $filter)
                            <tr>
                                <td>
                                    {{ $filter['filter_id'] }}
                                </td>
                                <td>
                                    <?php
                                        $filterName = ProductsFilter::getFilterName($filter['filter_id']);
                                        echo $filterName;
                                    ?>
                                </td>
                                <td>{{ $filter['filter_value'] }}</td>
                                <td>
                                    @if ($filter['status'] == 1)
                                        <a class="updateFilterValueStatus" id="filter-{{ $filter['id'] }}" filter_id="{{ $filter['id'] }}" href="javascript:void(0)">
                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;" title="Active" status="Active"></i>
                                        </a>
                                    @else
                                        <a class="updateFilterValueStatus" id="filter-{{ $filter['id'] }}" filter_id="{{ $filter['id'] }}" href="javascript:void(0)">
                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;" title="Inactive" status="Inactive"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('create.edit.filter.value', $filter['id']) }}"><i class="mdi mdi-pencil-box" style="font-size: 25px;"></i></a>
                                    <a href="javascript:void(0)" class="confirmDelete" module="filter" moduleid="{{ $filter['id'] }}"><i class="mdi mdi-file-excel-box" style="font-size: 25px;"></i></a>
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
            $('#filter_values').DataTable();
        });
    </script>
    <script>
        $(document).on('click', '.updateFilterValueStatus', function() {
            var status = $(this).children("i").attr("status");
            var filter_id = $(this).attr("filter_id");
            // alert(status);
            // alert(filter_id);
            $.ajax({
                type: 'post',
                url: '{{ route('update.filter.value.status') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status,
                    filter_id: filter_id
                },
                success: function(resp) {
                    // alert(resp['status']);
                    if (resp['status'] == 0) {
                        $("#filter-" + filter_id).html("<i class='mdi mdi-bookmark-outline' style='font-size: 25px;' title='Inactive' status='Inactive'></i>");
                    } else if (resp['status'] == 1) {
                        $("#filter-" + filter_id).html("<i class='mdi mdi-bookmark-check' style='font-size: 25px;' title='Active' status='Active'></i>");
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