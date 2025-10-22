<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id')->select('id', 'name');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->select('id', 'category_name');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id')->select('id', 'name');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->select('id', 'name');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id')->select('id', 'name');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public static function getDiscountPrice($product_id)
    {
        $productDetails = Product::select('product_price', 'product_discount', 'category_id')->where('id', $product_id)->first();
        $productDetails = json_decode(json_encode($productDetails), true);

        $categoryDetails = Category::select('category_discount')->where('id', $productDetails['category_id'])->first();
        $categoryDetails = json_decode(json_encode($categoryDetails), true);

        if ($productDetails['product_discount'] > 0) {

            $discountedPrice = $productDetails['product_price'] - ($productDetails['product_price'] * $productDetails['product_discount'] / 100);
        
        } elseif ($categoryDetails['category_discount'] > 0) {
            
            $discountedPrice = $productDetails['product_price'] - ($productDetails['product_price'] * $categoryDetails['category_discount'] / 100);

        } else {

            $discountedPrice = 0;
            
        }

        return $discountedPrice;
    }

    // public function getCategories()
    // {
    //     return $this->belongsTo(Category::class, 'id', 'category_id')->where([
    //         'parent_id' => 0,
    //         'status' => 1
    //     ])->with('subcategories');
    // }
    
    // public static function getQtyProduct($category_id)
    // {
    //     $qtyProduct = Product::with('getCategories')->where(['category_id' => $category_id, 'status' => 1])->count();
    //     return $qtyProduct;
    // }
}
