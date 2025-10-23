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

    public static function categoryDetails($url)
    {
        $categoryDetails = Category::select('id', 'category_name', 'url')->with('subcategories')->where('url', $url)->first()->toArray();
        // dd($categoryDetails);

        $catIds = array();
        $catIds[] = $categoryDetails['id'];
        foreach ($categoryDetails['subcategories'] as $key => $subcat) {
            $catIds[] = $subcat['id'];
        }
        // dd($catIds);

        $resp = array('catIds'=>$catIds, 'categoryDetails'=>$categoryDetails);
        return $resp;
    }

    // public static function getCategoryProductsCount($category_id)
    // {
    //     $qty = Category::with('products')->where(['parent_id' => 0, 'category_id' => $category_id])->count();
    //     return $qty . ' Products';
    // }
}
