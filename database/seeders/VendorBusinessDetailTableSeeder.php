<?php

namespace Database\Seeders;

use App\Models\VendorsBusinessDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBusinessDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorBusinessDetails = [
            [
                'id' => 1,
                'vendor_id' => 1,
                'shop_name' => 'John Doe Electronics',
                'shop_address' => '123 Tech Street, Silicon Valley, CA',
                'shop_city' => 'New York',
                'shop_state' => 'NY',
                'shop_country' => 'USA',
                'shop_pincode' => '10001',
                'shop_mobile' => '123-456-7890',
                'shop_website' => 'https://johndoetechhaven.com',
                'shop_email' => 'johndoeelc@gmail.com',
                'address_proof' => 'Utility Bill',
                'address_proof_image' => 'utility_bill_1.jpg',
                'business_license_number' => 'BLN123456',
                'gst_number' => 'GSTIN1234567',
                'pan_number' => 'PAN1234567',
            ]
            // Add more vendor business details as needed
        ];

        VendorsBusinessDetail::insert($vendorBusinessDetails);
    }
}
