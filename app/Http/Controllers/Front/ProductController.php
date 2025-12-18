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
        $url = Route::getFacadeRoot()->current()->uri(); // Get current route URL 
        // dd($url);
        $categoryCount = Category::where(['url'=>$url, 'status'=>1])->count(); // Check category is active or not

        // If category is active then show products else 404 page
        if ($categoryCount > 0) {

            // Get category details
            $categoryDetails = Category::categoryDetails($url);
            // dd($categoryDetails);

            // Get products under the category
            $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->get()->toArray();
            // dd($categoryDetails);
            // Get all the categories and sub-categories
            return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts'));
        } else {
            abort(404);
        }
    }
}
