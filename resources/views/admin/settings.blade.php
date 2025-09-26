@extends('admin.layout.layout')

@section('content')

@include('admin.alert')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Profile</h4>
                <form class="forms-sample" method="POST" action="{{ route('update.admin.profile') }}" enctype="multipart/form-data">@csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $dataAdmin['name'] }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $dataAdmin['email'] }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Admin Type</label>
                        <input type="text" class="form-control" id="type" name="type" placeholder="Admin Type" value="{{ $dataAdmin['type'] }}">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Phone</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="{{ $dataAdmin['mobile'] }}">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if (!empty($dataAdmin->image))
                            <a target="_blank" href="{{ asset('/user/photo/'.$dataAdmin->image) }}">View Image</a>
                            <input type="hidden" name="current_image" value="{{ $dataAdmin->image }}">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('dashboard.admin') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Password</h4>
                <form class="forms-sample" method="POST" action="{{ route('update.admin.password') }}">@csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" value="{{ $dataAdmin['name'] }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" value="{{ $dataAdmin['email'] }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="old_password">Current Password</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password">
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('dashboard.admin') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection