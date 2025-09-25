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
                'id'=>1, 
                'name'=>'Super Admin', 
                'type'=>'Superadmin', 
                'vendor_id'=>0, 
                'mobile'=>'082240312828', 
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('12345678'),
                'image'=>'',
                'status'=>1
            ],
        ];
        Admin::insert($adminRecords);
    }
}
