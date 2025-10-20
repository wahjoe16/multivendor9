@extends('admin.layout.layout')

@section('content')

@include('admin.alert')
<h4 class="card-title">{{ $title }}</h4>
<form method="POST" @if(empty($banner['id'])) action="{{ route('create.edit.banner') }}" @else action="{{ route('create.edit.banner', $banner['id']) }}" @endif enctype="multipart/form-data">
    @csrf
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Banner Attributes</h4>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Enter Subtitle">
                    </div>
                    <div class="form-group">
                        <label for="alt">Alt</label>
                        <input type="text" name="alt" id="alt" class="form-control" placeholder="Enter Alt">
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" name="link" id="link" class="form-control" placeholder="Enter Link">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="image">Banner Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success btn-sm">Save</button>
    <a href="{{ route('banners.view') }}" class="btn btn-light btn-sm">Cancel</a>
</form>

@endsection