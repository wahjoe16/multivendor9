<?php

namespace Database\Seeders;

use App\Models\ProductsFilter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filterRecords = [
            ['id' => 1, 'cat_ids' => '4,5,6,7,8,9,10,11,13,14,15', 'filter_name' => 'Fabric', 'filter_column' => 'fabric', 'status' => 1],
            ['id' => 2, 'cat_ids' => '1,2,3,16,17,18,19,20,21', 'filter_name' => 'RAM', 'filter_column' => 'ram', 'status' => 1],
        ];

        ProductsFilter::insert($filterRecords);
    }
}
