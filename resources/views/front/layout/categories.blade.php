<?php
    use App\Models\Section;

    $sections = Section::sections();
    // echo "<pre>"; print_r($sections); die;
?>

<div class="col-lg-3 d-none d-lg-block">
    <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
        <h6 class="m-0">Section Categories</h6>
        <i class="fa fa-angle-down text-dark"></i>
    </a>
    <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
        <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
            @foreach ($sections as $section)
                @if (count($section['categories']) >= 0)
                    <div class="nav-item dropdown">
                        <a href="javascript:;" class="nav-link" data-toggle="dropdown">{{ $section['name'] }} <i class="fa fa-angle-down float-right mt-1"></i></a>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            @foreach ($section['categories'] as $category)
                                <strong><a href="{{ url($category['url']) }}" class="nav-link" data-toggle="dropdown">{{ $category['category_name'] }} <i class="fa fa-angle-down float-right mt-1"></i></a></strong>
                                @foreach ($category['subcategories'] as $subcategory)
                                    <a href="{{ url($subcategory['url']) }}" class="nav-item nav-link">{{ $subcategory['category_name'] }}</a>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @endif
                
            @endforeach
            
        </div>
    </nav>
</div>