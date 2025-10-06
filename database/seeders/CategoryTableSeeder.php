<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesRecords = [
            [
                'id' => 1,
                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'Men',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'This is Men Category',
                'url' => '',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => 1
            ],
            [
                'id' => 2,
                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'Women',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'This is Women Category',
                'url' => '',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => 1
            ],
            [
                'id' => 3,
                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'Kids',
                'category_image' => '',
                'category_discount' => 0,
                'description' => 'This is Kids Category',
                'url' => '',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => 1
            ]
        ];

        Category::insert($categoriesRecords);
    }
}
