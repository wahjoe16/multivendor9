<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsFilter extends Model
{
    use HasFactory;
    protected $table = 'products_filter';

    // Function to get filter name by filter id
    public static function getFilterName($filter_id)
    {
        $getFilterName= ProductsFilter::select('filter_name')->where('id', $filter_id)->first();

        return $getFilterName->filter_name;
    }
}
