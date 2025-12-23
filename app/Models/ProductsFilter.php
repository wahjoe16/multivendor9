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
}
