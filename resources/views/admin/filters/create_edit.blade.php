@extends('admin.layout.layout')

@section('content')

@include('admin.alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>
                <form @if(empty($filter['id'])) action="{{ route('create.edit.filter') }}" @else action="{{ route('create.edit.filter', $filter['id']) }}" @endif method="POST" enctype="multipart/form-data">@csrf
                    
                    <div class="form-group">
                        <label for="cat_ids">Select Category</label>
                        <select name="cat_ids[]" id="cat_ids" class="form-control" multiple>
                            <option value="">Select</option>
                            @foreach ($categories as $section)
                                <optgroup label="{{ $section['name'] }}"></optgroup>
                                @foreach ($section['categories'] as $category)
                                    <option value="{{ $category['id'] }}" @if(!empty($filter['cat_ids'] == $category['id'])) selected @endif>&nbsp;&raquo;&nbsp;{{ $category['category_name'] }}</option>
                                    @foreach ($category['subcategories'] as $subcategory)
                                        <option value="{{ $subcategory['id'] }}" @if(!empty($filter['cat_ids'] == $subcategory['id'])) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="filter_name">Filter Name</label>
                        <input type="text" class="form-control" id="filter_name" name="filter_name" placeholder="Enter Filter Name" @if(!empty($filter['filter_name'])) value="{{ $filter['filter_name'] }}" @else value="{{ old('filter_name') }}" @endif>
                        
                    </div>
                    <div class="form-group">
                        <label for="filter_column">Filter Column</label>
                        <input type="text" class="form-control" id="filter_column" name="filter_column" placeholder="Enter Filter Name" @if(!empty($filter['filter_column'])) value="{{ $filter['filter_column'] }}" @else value="{{ old('filter_column') }}" @endif>
                        
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('categories.view') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('bottom-scripts')
    <script>
        $(document).ready(function(){
            $('#section_id').change(function(){
                var section_id = $(this).val();
                $.ajax({
                    type: 'get',
                    url: `{{ route('append.categories.level') }}`,
                    data: {section_id:section_id},
                    success:function(resp){
                        $('#appendCategoryLevel').html(resp);
                    },error:function(){
                        alert("Error");
                    }
                });
            });
        });
    </script>
    
@endpush
