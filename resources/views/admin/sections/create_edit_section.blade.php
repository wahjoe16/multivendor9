@extends('admin.layout.layout')

@section('content')

@include('admin.alert')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>
                <form method="post" @if(empty($section['id'])) action="{{ route('create.edit.section') }}" @else action="{{ route('create.edit.section', $section['id']) }}" @endif>
                    @csrf
                    <div class="form-group">
                        <label for="section_name">Section Name</label>
                        <input type="text" class="form-control" id="section_name" name="name" placeholder="Enter Section Name" @if(!empty($section['name'])) value="{{ $section['name'] }}" @else value="{{ old('name') }}" @endif>
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('sections.view') }}" class="btn btn-light" type="reset">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection