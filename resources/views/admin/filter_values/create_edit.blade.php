@extends('admin.layout.layout')

@section('content')

@include('admin.alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>
                <form @if(empty($filterValue['id'])) action="{{ route('create.edit.filter.value') }}" @else action="{{ route('create.edit.filter.value', $filterValue['id']) }}" @endif method="POST" enctype="multipart/form-data">@csrf
                    
                    <div class="form-group">
                        <label for="filter_id">Filter</label>
                        <select name="filter_id" id="filter_id" class="form-control">
                            <option value="">Select</option>
                            @foreach ($filters as $filter)
                                <option value="{{ $filter['id'] }}" @if(!empty($filterValue['filter_id'] == $filter['id'])) selected @endif>{{ $filter['filter_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="filter_value">Filter Value</label>
                        <input type="text" class="form-control" id="filter_value" name="filter_value" placeholder="Enter Filter Name" @if(!empty($filterValue['filter_value'])) value="{{ $filterValue['filter_value'] }}" @else value="{{ old('filter_value') }}" @endif>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('categories.view') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection