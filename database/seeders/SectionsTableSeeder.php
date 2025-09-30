<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            ['name' => 'Electronics', 'status' => 1],
            ['name' => 'Fashion', 'status' => 1],
            ['name' => 'Home & Garden', 'status' => 1],
            ['name' => 'Sports', 'status' => 1],
            ['name' => 'Hobies', 'status' => 1],
        ];

        Section::insert($sections);
    }
}
