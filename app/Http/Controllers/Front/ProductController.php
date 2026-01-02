<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductsFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    public function listing(Request $request)
    {
        // sorting produk dengan ajax
        if ($request->ajax()) {

            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            $url = $data['url']; // assign url ke variable dari input data hidden url
            // dd($url);
            $_GET['sort'] = $data['sort']; // assign sort ke variable dari input data hidden sort
            $categoryCount = Category::where(['url'=>$url, 'status'=>1])->count(); // Check category is active or not

            // If category is active then show products else 404 page
            if ($categoryCount > 0) {

                // Get category details
                $categoryDetails = Category::categoryDetails($url);
                // dd($categoryDetails);

                // Get products under the category
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

                // filter berdasarkan fabric
                // if (isset($data['fabric']) && !empty($data['fabric'])) {
                //     $categoryProducts->whereIn('products.fabric', $data['fabric']);
                // }

                // cek untuk filter dinamis
                $productFilters = ProductsFilter::productFilters();
                foreach ($productFilters as $key => $filter) {
                    if (isset($filter['filter_column']) && isset($data[$filter['filter_column']]) && !empty($filter['filter_column']) && !empty($data[$filter['filter_column']])) {
                        $categoryProducts->whereIn($filter['filter_column'], $data[$filter['filter_column']]);
                    }
                }

                // cek untuk filter by size
                if (isset($data['size']) && !empty($data['size'])) {
                    // mendapatkan product_id dari tabel product_attributes berdasarkan size yang dipilih
                    $productIds = ProductAttribute::select('product_id')->whereIn('size', $data['size'])->pluck('product_id')->toArray(); 
                    $categoryProducts->whereIn('products.id', $productIds); // filter produk berdasarkan product_id yang didapatkan
                }

                // filter berdasarkan color / warna
                if (isset($data['color']) && !empty($data['color'])) {
                    $productIds = Product::select('id')->whereIn('product_color', $data['color'])->pluck('id')->toArray();
                    $categoryProducts->whereIn('products.id', $productIds);
                }

                // filter berdasarkan brand / merek
                if (isset($data['brand']) && !empty($data['brand'])) { // cek jika ada filter brand
                    $productIds = Product::select('id')->whereIn('brand_id', $data['brand'])->pluck('id')->toArray(); // ambil product id berdasarkan brand yang dipilih
                    $categoryProducts->whereIn('products.id', $productIds); // filter produk berdasarkan product_id yang didapatkan
                }

                // filter berdasarkan price / harga
                if (isset($data['price']) && !empty($data['price'])) { // cek jika ada filter price
                    $implodePrice = implode('-', $data['price']); // gabungkan array menjadi string dengan pemisah '-'
                    $explodePrice = explode('-', $implodePrice); // pecah string menjadi array berdasarkan '-'
                    $minPrice = reset($explodePrice); // ambil nilai pertama sebagai min price
                    $maxPrice = end($explodePrice); // ambil nilai terakhir sebagai max price
                    $productIds = Product::select('id')->whereBetween('product_price', [$minPrice, $maxPrice])->pluck('id')->toArray(); // ambil product id berdasarkan rentang harga yang dipilih
                    $categoryProducts->whereIn('products.id', $productIds); // filter produk berdasarkan product_id yang didapatkan
                }

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

                $categoryProducts = $categoryProducts->paginate(12);
                // dd($categoryDetails);
                // Get all the categories and sub-categories
                return view('front.products.ajax_products_listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }

        } else {

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

                $categoryProducts = $categoryProducts->paginate(12);
                // dd($categoryDetails);
                // Get all the categories and sub-categories
                return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }

        }
        
    }

    public function detail($id)
    {
        $data = Product::with([
            'attributes', 'images', 'section', 'category', 'brand', 'vendor'
        ])->findOrFail($id);

        // $categoryDetails = Category::categoryDetails($data['category']['url'] ?? null);
        // dd($categoryDetails);
        return view('front.products.detail', compact('data'));
    }
}
