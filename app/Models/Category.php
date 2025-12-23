<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id')->select('id', 'name');
    }

    public function parentcategory()
    {
        return $this->belongsTo(Category::class, 'parent_id')->select('id', 'category_name');
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    // Function to get category details and its sub-categories
    public static function categoryDetails($url)
    {
        // select detail kategori berdasarkan url
        $categoryDetails = Category::select('id', 'parent_id', 'category_name', 'url')->with(['subcategories' => function($query){
            $query->select('id', 'parent_id', 'category_name', 'url');
        }])->where('url', $url)->first()->toArray();
        // dd($categoryDetails);

        
        $catIds = array(); // Array untuk menampung id kategori dan sub-kategori
        $catIds[] = $categoryDetails['id']; // Memasukkan id kategori utama ke dalam array

        // hanya menampilkan main category di breadcrumbs
        if ($categoryDetails['parent_id'] == 0) {
            $brandcrumbs = '<a href="'.url($categoryDetails['url']).'" class="breadcrumb-item text-dark">'.$categoryDetails['category_name'].'</a>';
        } else { // menampilkan main category dan sub category di breadcrumbs
            $parentCategory = Category::select('category_name', 'url')->where('id', $categoryDetails['parent_id'])->first()->toArray();
            // tambahkan parent category ke breadcrumbs
            $brandcrumbs = '<a href="'.url($parentCategory['url']).'" class="breadcrumb-item text-dark">'.$parentCategory['category_name'].'</a> &nbsp; <a href="'.url($categoryDetails['url']).'" class="breadcrumb-item text-dark">'.$categoryDetails['category_name'].'</a>';
        }

        // Memasukkan id sub-kategori ke dalam array
        foreach ($categoryDetails['subcategories'] as $key => $subcat) {
            $catIds[] = $subcat['id']; // Memasukkan id sub-kategori ke dalam array
        }
        // dd($catIds);

        // Return data dalam bentuk array 
        $resp = array('catIds'=>$catIds, 'categoryDetails'=>$categoryDetails, 'brandcrumbs'=>$brandcrumbs);
        return $resp;
    }

    // Function to get category name by category id
    public static function getCategoryName($category_id)
    {
        $getCategoryName= Category::select('category_name')->where('id', $category_id)->first();

        return $getCategoryName->category_name;
    }

    // public static function getCategoryProductsCount($category_id)
    // {
    //     $qty = Category::with('products')->where(['parent_id' => 0, 'category_id' => $category_id])->count();
    //     return $qty . ' Products';
    // }
}
