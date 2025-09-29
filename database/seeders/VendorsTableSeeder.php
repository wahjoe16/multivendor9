<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorRecords = [
            [
                'id'=>1, 
                'name'=>'John', 
                'address'=>'CP-112',
                'city'=>'New York',
                'state'=>'NY',
                'country'=>'USA',
                'pincode'=>'10001',
                'mobile'=>'1234567890',
                'email'=>'john@gmail.com',
                'status'=>0
            ]
        ];
        \App\Models\Vendor::insert($vendorRecords);
    }
}
