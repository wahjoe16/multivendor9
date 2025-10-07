@extends('admin.layout.layout')

@section('content')

@include('admin.alert')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>
                <form @if(empty($category['id'])) action="{{ route('create.edit.category') }}" @else action="{{ route('create.edit.category', $category['id']) }}" @endif method="POST" enctype="multipart/form-data">@csrf
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name" @if(!empty($category['category_name'])) value="{{ $category['category_name'] }}" @else value="{{ old('category_name') }}" @endif>
                        
                    </div>
                    <div class="form-group">
                        <label for="section_id">Select Section</label>
                        <select class="form-control" id="section_id" name="section_id">
                            <option value="">Select</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section['id'] }}" @if(!empty($category['section_id']) && $category['section_id']==$section['id']) selected @endif>{{ $section['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="appendCategoryLevel">
                        @include('admin.categories.append_category_level')
                    </div>
                    <div class="form-group">
                        <label for="category_discount" class="col-form-label">Category Discount</label>
                        <input type="numeric" class="form-control" id="category_discount" name="category_discount" placeholder="Enter Category Discount" @if(!empty($category['category_discount'])) value="{{ $category['category_discount'] }}" @else value="{{ old('category_discount') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Category Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter Category Description">@if(!empty($category['description'])){{ $category['description'] }}@else{{ old('description') }}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="url" class="col-form-label">Category URL</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Enter Category URL" @if(!empty($category['url'])) value="{{ $category['url'] }}" @else value="{{ old('url') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="meta_title" class="col-form-label">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title" @if(!empty($category['meta_title'])) value="{{ $category['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="meta_description" class="col-form-label">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" placeholder="Enter Meta Description">@if(!empty($category['meta_description'])){{ $category['meta_description'] }}@else{{ old('meta_description') }}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_keywords" class="col-form-label">Meta Keywords</label>
                        <textarea class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter Meta Keywords">@if(!empty($category['meta_keywords'])){{ $category['meta_keywords'] }}@else{{ old('meta_keywords') }}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category_image" class="col-form-label">Category Image</label>
                        <input type="file" class="form-control" id="category_image" name="category_image">
                        @if (!empty($category->category_image))
                            <a target="_blank" href="{{ asset('/images/category_images/'.$category->category_image) }}">View Image</a>
                            <input type="hidden" name="current_image" value="{{ $category->category_image }}">
                        @endif
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
