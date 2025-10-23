<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    public function listing()
    {
        // echo "Product Listing Page"; die;
        $url = Route::getFacadeRoot()->current()->uri();
        $categoryCount = Category::where(['url'=>$url, 'status'=>1])->count();
        if ($categoryCount > 0) {
            $categoryDetails = Category::categoryDetails($url);
            // dd($categoryDetails);
            $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->get()->toArray();
            // dd($categoryProducts);
            // Get all the categories and sub-categories
            return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts'));
        } else {
            abort(404);
        }
    }
}
