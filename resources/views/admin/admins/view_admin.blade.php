@extends('admin.layout.layout')

@section('content')

@include('admin.alert')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>
                <div class="table-responsive pt-3">
                    <table id="admins" class="table table-striped">
                        <thead>
                            <tr>
                                <th> User </th>
                                <th> Name </th>
                                <th> Type </th>
                                <th> Email </th>
                                <th> Mobile </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                            <tr>
                                <td class="py-1"> 
                                    @if (!empty($admin->image))
                                        <img src="{{ asset('user/photo/'.$admin->image) }}" alt="">
                                    @else
                                        <img src="{{ asset('admin/images/photos/no-image.png') }}" alt="">
                                    @endif
                                </td>
                                <td> {{ $admin->name }} </td>
                                <td> {{ $admin->type }} </td>
                                <td> {{ $admin->email }} </td>
                                <td> {{ $admin->mobile }} </td>
                                <td> 
                                    @if ($admin->status == 1)
                                        <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{ $admin->id }}" admin_id="{{ $admin->id }}">
                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;" title="Active" status="Active"></i>
                                        </a>
                                        {{-- <span style="color: green">Active</span> --}}
                                    @else
                                        <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{ $admin->id }}" admin_id="{{ $admin->id }}">
                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;" title="Inactive" status="Inactive"></i>
                                        </a>
                                        {{-- <span style="color: red">Inactive</span> --}}
                                    @endif
                                </td>
                                <td> 
                                    @if ($admin->type != "vendor")
                                        <a href="{{ route('show.vendor', $admin->id) }}">
                                            <i class="mdi mdi-account-search" style="font-size: 25px;" title="View Vendor Details"></i>
                                        </a>
                                    @endif
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
   <script>
        $(document).ready(function(){
            $(document).on("click", ".updateAdminStatus", function(){
                var status = $(this).children("i").attr("status");
                var admin_id = $(this).attr("admin_id");
                // alert(admin_id);
                $.ajax({
                    type: 'post',
                    url: `{{ route('update.admin.status') }}`,
                    data: {status: status, admin_id: admin_id, _token: '{{ csrf_token() }}'},
                    success: function(resp){
                        // alert(resp);
                        if (resp['status'] == 0) {
                            $("#admin-"+admin_id).html("<i class='mdi mdi-bookmark-outline' style='font-size: 25px;' title='Inactive' status='Inactive'></i>");
                        } else if (resp['status'] == 1) {
                            $("#admin-"+admin_id).html("<i class='mdi mdi-bookmark-check' style='font-size: 25px;' title='Active' status='Active'></i>");
                        }
                    }, error: function(){
                        alert("Error");
                    }
                });
            });
        });
    </script> 
@endpush