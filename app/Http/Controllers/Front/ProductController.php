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
            $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

            // cek untuk sorting data
            if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                if ($_GET['sort'] == "product_latest") {
                    $categoryProducts = $categoryProducts->orderBy('id', 'Desc');
                } elseif ($_GET['sort'] == "name_asc") {
                    $categoryProducts = $categoryProducts->orderBy('product_name', 'Asc');
                } elseif ($_GET['sort'] == "name_desc") {
                    $categoryProducts = $categoryProducts->orderBy('product_name', 'Desc');
                } elseif ($_GET['sort'] == "price_lowest") {
                    $categoryProducts = $categoryProducts->orderBy('product_price', 'Asc');
                } elseif ($_GET['sort'] == "price_highest") {
                    $categoryProducts = $categoryProducts->orderBy('product_price', 'Desc');
                }
            } else {
                $categoryProducts = $categoryProducts->orderBy('id', 'Desc');
            }

            $categoryProducts = $categoryProducts->paginate(3);
            // dd($categoryDetails);
            // Get all the categories and sub-categories
            return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts'));
        } else {
            abort(404);
        }
    }
}
