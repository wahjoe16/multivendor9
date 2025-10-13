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
}
