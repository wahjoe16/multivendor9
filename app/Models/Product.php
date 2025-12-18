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

    // Function to get discounted price of a product
    public static function getDiscountPrice($product_id)
    {
        // mengambil detail produk berdasarkan product_id 
        $productDetails = Product::select('product_price', 'product_discount', 'category_id')->where('id', $product_id)->first();
        $productDetails = json_decode(json_encode($productDetails), true); // konversi ke array

        // mengambil detail kategori berdasarkan category_id
        $categoryDetails = Category::select('category_discount')->where('id', $productDetails['category_id'])->first();
        $categoryDetails = json_decode(json_encode($categoryDetails), true); // konversi ke array

        // Jika ada diskon di produk maka ambil diskon produk
        if ($productDetails['product_discount'] > 0) {
            // Hitung harga diskon
            $discountedPrice = $productDetails['product_price'] - ($productDetails['product_price'] * $productDetails['product_discount'] / 100);
            // Jika tidak ada diskon di produk tetapi ada diskon di kategori maka ambil diskon kategori
        } elseif ($categoryDetails['category_discount'] > 0) {
            // Hitung harga diskon
            $discountedPrice = $productDetails['product_price'] - ($productDetails['product_price'] * $categoryDetails['category_discount'] / 100);
            // Jika tidak ada diskon di produk maupun di kategori maka harga diskon = 0
        } else {
            
            $discountedPrice = 0;
            
        }

        // Return harga diskon
        return $discountedPrice;
    }

    // Fungsi untuk mengecek apakah produk itu produk baru atau bukan
    public static function isProductNew($product_id)
    {
        // mengambil 3 produk terbaru berdasarkan id
        $productIds = Product::select('id')->where('status', 1)->orderBy('id', 'DESC')->limit(3)->get()->pluck('id');
        $productIds = json_decode(json_encode($productIds), true); // konversi ke array
        // dd($productIds);

        // Cek apakah product_id ada di dalam array produk terbaru
        if (in_array($product_id, $productIds)) {
            return $isProductNew = "Yes";
        } else {
            return $isProductNew = "No";
        }

        return $isProductNew;
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
