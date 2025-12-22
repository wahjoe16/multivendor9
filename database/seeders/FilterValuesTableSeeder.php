<?php

namespace Database\Seeders;

use App\Models\ProductFilterValues;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilterValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filterValueRecords = [
            [
                'id' => 1, 'filter_id' => 1, 'filter_value' => 'Cotton', 'status' => 1,
            ],
            [
                'id' => 2, 'filter_id' => 1, 'filter_value' => 'Polyester', 'status' => 1,
            ],
            [
                'id' => 3, 'filter_id' => 2, 'filter_value' => '4GB', 'status' => 1,
            ],
            [
                'id' => 4, 'filter_id' => 2, 'filter_value' => '8GB', 'status' => 1,
            ],
        ];

        ProductFilterValues::insert($filterValueRecords);
    }
}
