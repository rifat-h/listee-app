<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Automobiles',
                'icon' => 'fas fa-car',
                'description' => 'গাড়ি, বাইক, সাইকেল এবং যানবাহন সংক্রান্ত বিজ্ঞাপন',
                'color' => '#FF3B30',
            ],
            [
                'name' => 'Property',
                'icon' => 'fas fa-home',
                'description' => 'বাড়ি, ফ্ল্যাট, জমি, অফিস ভাড়া ও বিক্রি',
                'color' => '#4c6ef5',
            ],
            [
                'name' => 'Electronics',
                'icon' => 'fas fa-laptop',
                'description' => 'মোবাইল, ল্যাপটপ, কম্পিউটার, ইলেকট্রনিক্স',
                'color' => '#37b24d',
            ],
            [
                'name' => 'Jobs',
                'icon' => 'fas fa-briefcase',
                'description' => 'চাকরি, ফ্রিল্যান্সিং, পার্ট-টাইম জব',
                'color' => '#f59f00',
            ],
            [
                'name' => 'Education',
                'icon' => 'fas fa-graduation-cap',
                'description' => 'টিউশন, কোর্স, বই, শিক্ষা সামগ্রী',
                'color' => '#7950f2',
            ],
            [
                'name' => 'Services',
                'icon' => 'fas fa-concierge-bell',
                'description' => 'সার্ভিস, রিপেয়ারিং, হোম সার্ভিস',
                'color' => '#e64980',
            ],
            [
                'name' => 'Fashion',
                'icon' => 'fas fa-tshirt',
                'description' => 'জামা-কাপড়, জুতা, ব্যাগ, ঘড়ি',
                'color' => '#20c997',
            ],
            [
                'name' => 'Pets & Animals',
                'icon' => 'fas fa-paw',
                'description' => 'পোষা প্রাণী, পাখি, মাছ',
                'color' => '#fd7e14',
            ],
            [
                'name' => 'Furniture',
                'icon' => 'fas fa-couch',
                'description' => 'আসবাবপত্র, হোম ডেকোর',
                'color' => '#845ef7',
            ],
            [
                'name' => 'Health & Beauty',
                'icon' => 'fas fa-heartbeat',
                'description' => 'স্বাস্থ্য, বিউটি, ফিটনেস পণ্য',
                'color' => '#f06595',
            ],
            [
                'name' => 'Sports & Hobbies',
                'icon' => 'fas fa-futbol',
                'description' => 'খেলাধুলা, শখ, বাদ্যযন্ত্র',
                'color' => '#15aabf',
            ],
            [
                'name' => 'Others',
                'icon' => 'fas fa-th-large',
                'description' => 'অন্যান্য সব ধরনের বিজ্ঞাপন',
                'color' => '#868e96',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name'        => $category['name'],
                'slug'        => Str::slug($category['name']),
                'icon'        => $category['icon'],
                'description' => $category['description'],
                'color'       => $category['color'],
                'is_active'   => true,
            ]);
        }
    }
}