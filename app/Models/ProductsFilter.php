<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsFilter extends Model
{
    use HasFactory;
    protected $table = 'products_filter';

    // Define relationship with ProductFilterValues model
    public function filter_values()
    {
        return $this->hasMany(ProductFilterValues::class, 'filter_id');
    }

    // Function to get filter name by filter id
    public static function getFilterName($filter_id)
    {
        $getFilterName= ProductsFilter::select('filter_name')->where('id', $filter_id)->first();

        return $getFilterName->filter_name;
    }

    // Function to get all product filters with their values
    public static function productFilters()
    {
        $productFilters = ProductsFilter::with('filter_values')->where('status', 1)->get()->toArray(); // Retrieve all filters with their associated values where status is 1
        // dd($productFilters);
        return $productFilters; // Return the array of product filters with their values
    }

    // Function to check if a filter is available for a given category
    public static function filterAvailable($filter_id, $category_id)
    {
        $filterAvailable = ProductsFilter::select('cat_ids')->where([
            'id' => $filter_id,
            'status' => 1,
        ])->first()->toArray(); // Retrieve the cat_ids for the given filter_id where status is 1

        $catIdsArr = explode(',', $filterAvailable['cat_ids']); // Convert the comma-separated cat_ids string into an array

        if (in_array($category_id, $catIdsArr)) {
            $available = "Yes";
        } else {
            $available = "No";
        }

        return $available; // Return whether the filter is available for the given category
    }

    // fungsi untuk mendapatkan size berdasarkan category url
    public static function getSizes($url)
    {
        // mendapatkan detail category berdasarkan url
        $categoryDetails = Category::categoryDetails($url); 

        // mendapatkan product_id berdasarkan category_id dari detail category
        $getProductIds = Product::whereIn('category_id', $categoryDetails['catIds'])->pluck('id')->toArray(); 

        // mendapatkan size dari product_attributes berdasarkan product_id yang didapatkan sebelumnya
        $getProductSizes = ProductAttribute::select('size')->whereIn('product_id', $getProductIds)->groupBy('size')->pluck('size')->toArray();  

        // echo "<pre>";
        // print_r($getProductSizes);
        // die;

        return $getProductSizes; // mengembalikan nilai size
    }


    public static function getColors($url)
    {
        // mendapatkan detail category berdasarkan url
        $categoryDetails = Category::categoryDetails($url);

        // mendapatkan product_id berdasarkan category_id dari detail category
        $getProductIds = Product::whereIn('category_id', $categoryDetails['catIds'])->pluck('id')->toArray();


        $getProductColors = Product::select('product_color')->whereIn('id', $getProductIds)->groupBy('product_color')->pluck('product_color')->toArray();

        // echo "<pre>"; print_r($getProductColors); die;

        return $getProductColors;
    }

    public static function getBrands($url)
    {
        // mendapatkan detail category berdasarkan url
        $categoryDetails = Category::categoryDetails($url);

        // mendapatkan product_id berdasarkan category_id dari detail category
        $getProductIds = Product::select('id')->whereIn('category_id', $categoryDetails['catIds'])->pluck('id')->toArray();

        // mengembalikan brand_id dari product berdasarkan product_id yang didapatkan sebelumnya
        $brandIds = Product::select('brand_id')->whereIn('id', $getProductIds)->groupBy('brand_id')->pluck('brand_id')->toArray();

        // mendapatkan detail brand berdasarkan brand_id yang didapatkan sebelumnya
        $brandDetails = Brand::select('id', 'name')->whereIn('id', $brandIds)->get()->toArray();
        
        // echo "<pre>"; print_r($brandDetails); die;

        return $brandDetails;
    }
}
