@extends('front.layout.layout')

@section('content')

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('dashboard') }}">Home</a>
                    <span class="breadcrumb-item active">Sign In or Sign Up</span>
                </nav>
            </div>
        </div>

        @include('front.session_alert')
    </div>
    <!-- Breadcrumb End -->

    

    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-6 mb-5">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Vendor
                        Sign In</span></h5>
                <div class="bg-light p-30 mb-5">
                    <form action="{{ route('login.admin') }}" method="POST">@csrf
                        <div class="form-group">
                            <label class="mb-2" for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label class="mb-2" for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                        </div>
                        <div>
                            <button class="btn btn-primary btn-block py-2 px-4" type="submit" id="sendMessageButton">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 mb-5">
                <h5 class="section-title position-relative text-uppercase mb-3"><span
                        class="bg-secondary pr-3">Vendor Sign Up</span></h5>
                <div class="bg-light p-30 mb-5">
                    <form action="{{ route('vendor.register') }}" method="POST">@csrf
                        <div class="form-group">
                            <label class="mb-2" for="vendorname">Name</label>
                            <input type="text" name="name" class="form-control" id="vendorname" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label class="mb-2" for="vendormobile">Mobile</label>
                            <input type="text" name="mobile" class="form-control" id="vendormobile" placeholder="Enter Mobile">
                        </div>
                        <div class="form-group">
                            <label class="mb-2" for="vendoremail">Email</label>
                            <input type="text" name="email" class="form-control" id="vendoremail" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label class="mb-2" for="vendorpassword">Password</label>
                            <input type="password" name="password" class="form-control" id="vendorpassword" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="accept" id="acceptTerms" class="mr-2">
                            <label for="acceptTerms" class="mb-2">Accept Terms & Conditions</label>
                        </div>
                        <div>
                            <button class="btn btn-primary btn-block py-2 px-4" type="submit" id="sendMessageButton">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection