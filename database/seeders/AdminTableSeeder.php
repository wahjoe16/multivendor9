<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRecords = [
            [
                'id'=>2, 
                'name'=>'John', 
                'type'=>'Vendor', 
                'vendor_id'=>1, 
                'mobile'=>'082240312827', 
                'email'=>'john@gmail.com',
                'password'=>bcrypt('12345678'),
                'image'=>'',
                'status'=>1
            ],
        ];
        Admin::insert($adminRecords);
    }
}
