@extends('admin.layout.layout')

@section('content')

@include('admin.alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Management Banners</h4>
                <a href="{{ route('create.edit.banner') }}" class="btn btn-success mb-3">Create New Banner</a>
                <div class="table-responsive">
                    <table id="products" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $banner)
                            <tr>
                                <td>
                                    @if (!empty($banner->image))
                                        <img src="{{ asset('/images/banners/' . $banner->image) }}" style="width: 50px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $banner->title }}</td>
                                <td>{{ $banner->subtitle }}</td>
                                <td>
                                    @if ($banner->status == 1)
                                        <a class="updateBannerStatus" id="banner-{{ $banner->id }}" banner_id="{{ $banner->id }}" href="javascript:void(0)">
                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;" title="Active" status="Active"></i>
                                        </a>
                                    @else
                                        <a class="updateBannerStatus" id="banner-{{ $banner->id }}" banner_id="{{ $banner->id }}" href="javascript:void(0)">
                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;" title="Inactive" status="Inactive"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('banner.show', ['id' => $banner->id]) }}" title="Show Banner"><i class="mdi mdi-eye" style="font-size: 25px;"></i></a>
                                    <a href="{{ route('create.edit.banner', ['id' => $banner->id]) }}" title="Edit Banner"><i class="mdi mdi-pencil-box" style="font-size: 25px;"></i></a>
                                    <a href="javascript:void(0)" class="confirmDelete" module="banner" moduleid="{{ $banner->id }}" title="Delete Banner"><i class="mdi mdi-file-excel-box" style="font-size: 25px;"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Subtitle</th>
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