<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $banner = Banner::where('status', 1)->get()->toArray();
        $recentProducts = Product::orderBy('id', 'DESC')->limit(8)->get()->toArray();
        $gridCategory = Category::where([
            'status' => 1,
            'parent_id' => 0
        ])->inRandomOrder()->get()->toArray();
        $discountedProducts = Product::where('product_discount', '>', 0)->inRandomOrder()->limit(8)->get()->toArray();
        return view('front.index', compact('banner', 'recentProducts', 'gridCategory', 'discountedProducts'));
    }
}
