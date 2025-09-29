<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBankDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorBankDetails = [
            [
                'id' => 1,
                'vendor_id' => 1,
                'account_holder_name' => 'John Doe',
                'bank_name' => 'Bank of America',
                'account_number' => '1234567890',
                'bank_ifsc_code' => 'BOFAUS3N',
            ]
            // Add more vendor bank details as needed
        ];

        \App\Models\VendorsBankDetail::insert($vendorBankDetails);
    }
}
