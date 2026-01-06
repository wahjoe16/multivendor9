<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    public function vendorsBusinessDetail()
    {
        return $this->belongsTo(VendorsBusinessDetail::class, 'id', 'vendor_id');
    }

    public static function getVendorShop($vendor_id)
    {
        $getVendorShop = VendorsBusinessDetail::select('shop_name')->where('vendor_id', $vendor_id)->first()->toArray();
        return $getVendorShop['shop_name'];
    }
}
