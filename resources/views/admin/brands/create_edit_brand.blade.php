@extends('admin.layout.layout')

@section('content')

@include('admin.alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>
                <form method="POST" @if(empty($brand['id'])) action="{{ route('create.edit.brand') }}" @else action="{{ route('create.edit.brand', $brand['id']) }}" @endif>@csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label">Brand Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Brand Name" @if(!empty($brand['name'])) value="{{ $brand['name'] }}" @else value="{{ old('name') }}" @endif>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('brands.view') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('bottom-scripts')
    
@endpush