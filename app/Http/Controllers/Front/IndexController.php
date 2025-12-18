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
        // menampilkan slider
        $banner = Banner::where('status', 1)->get()->toArray();

        // menampilkan 8 product terakhir
        $recentProducts = Product::orderBy('id', 'DESC')->limit(8)->get()->toArray();

        // menampilkan root category secara acak yang tidak punya parent category
        $gridCategory = Category::where([
            'status' => 1,
            'parent_id' => 0
        ])->inRandomOrder()->get()->toArray();

        // menampilkan 8 produk yang ada diskonnya dan ditemapilkan secara acak
        $discountedProducts = Product::where('product_discount', '>', 0)->inRandomOrder()->limit(8)->get()->toArray();
        
        return view('front.index', compact('banner', 'recentProducts', 'gridCategory', 'discountedProducts'));
    }
}
