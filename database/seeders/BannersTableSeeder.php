<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bannerRecords = [
            [
                'id' => 1, 'image' => 'carousel-1.jpg', 'link' => 'https://sift.unisba.ac.id/login', 
                'title' => 'Fashionable Dress', 'subtitle' => '10% Off Your First Order', 'alt' => '...',
                'status' => 1
            ],
            [
                'id' => 1, 'image' => 'carousel-2.jpg', 'link' => 'https://sift.unisba.ac.id/login', 
                'title' => 'Reasonable Price', 'subtitle' => '10% Off Your First Order', 'alt' => '...',
                'status' => 1
            ],
        ];

        Banner::insert($bannerRecords);
    }
}
