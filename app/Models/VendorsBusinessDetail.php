<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorsBusinessDetail extends Model
{
    use HasFactory;
    protected $table = 'vendors_business_details';
    protected $fillable = [
        'vendor_id',
        'shop_name',
        'shop_address',
        'shop_city',
        'shop_state',
        'shop_country',
        'shop_pincode',
        'shop_mobile',
        'shop_website',
        'shop_email',
        'address_proof',
        'business_license_number',
        'gst_number',
        'pan_number',
        'address_proof_image',
    ];
}
