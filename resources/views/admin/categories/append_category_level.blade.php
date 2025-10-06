<div class="form-group">
    <label for="parent_id">Select Category Level</label>
    <select class="form-control" id="parent_id" name="parent_id">
        <option value="0">Main Category</option>
        @if(!empty($getCategories))
            @foreach ($getCategories as $parentCategory)
                <option value="{{ $parentCategory['id'] }}" @if(null !== ($parentCategory['parent_id'] && $parentCategory['parent_id']==$parentCategory['id'])) selected @endif>{{ $parentCategory['category_name'] }}</option>
                @if (!empty($parentCategory['subcategories']))
                    @foreach ($parentCategory['subcategories'] as $subcategory)
                        <option value="{{ $subcategory['id'] }}" @if(null !== ($subcategory['parent_id'] && $subcategory['parent_id']==$subcategory['id'])) selected @endif>&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                    @endforeach
                @endif
            @endforeach
        @endif
    </select>
</div>