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
                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;" title="Active"></i>
                                        </a>
                                        {{-- <span style="color: green">Active</span> --}}
                                    @else
                                        <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{ $admin->id }}" admin_id="{{ $admin->id }}">
                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;" title="Inactive"></i>
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

@endsection