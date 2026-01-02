<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'mobile',
        'image',
        'status',
    ];

    public function vendorPersonal()
    {
        return $this->hasOne(Vendor::class, 'admins_id', 'id');
    }

    public function vendorBusiness()
    {
        return $this->hasOne(VendorsBusinessDetail::class, 'admins_id', 'id');
    }

    public function vendorBank()
    {
        return $this->hasOne(VendorsBankDetail::class, 'admins_id', 'id');
    }
}
