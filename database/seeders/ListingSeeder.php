<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('is_admin', false)->pluck('id')->toArray();
        $categories = Category::pluck('id', 'name')->toArray();

        $listings = [
            // Automobiles
            [
                'title'       => 'Toyota Corolla 2020 - Full Fresh',
                'description' => 'Toyota Corolla 2020 মডেল, সম্পূর্ণ ফ্রেশ কন্ডিশন। AC, পাওয়ার উইন্ডো, সেন্ট্রাল লক সব আছে। মাত্র ২৫,০০০ কিমি চলেছে। কোনো দুর্ঘটনার ইতিহাস নেই।',
                'price'       => 2800000,
                'category'    => 'Automobiles',
                'location'    => 'Dhaka, Gulshan',
                'is_featured' => true,
            ],
            [
                'title'       => 'Honda CB Hornet 160R - 2021',
                'description' => 'Honda CB Hornet 160R, ২০২১ মডেল। মাত্র ৮,০০০ কিমি চলেছে। সকল কাগজপত্র ঠিক আছে। Single owner.',
                'price'       => 195000,
                'category'    => 'Automobiles',
                'location'    => 'Chittagong, Agrabad',
                'is_featured' => false,
            ],

            // Property
            [
                'title'       => '3 Bedroom Flat for Rent - Dhanmondi',
                'description' => 'ধানমন্ডিতে ১৩৫০ স্কয়ার ফিটের সুন্দর ৩ বেডরুমের ফ্ল্যাট ভাড়া দেওয়া হবে। ২টি বাথরুম, বড় বসার ঘর, মডার্ন কিচেন। লিফট ও জেনারেটর সুবিধা আছে।',
                'price'       => 35000,
                'category'    => 'Property',
                'location'    => 'Dhaka, Dhanmondi',
                'is_featured' => true,
            ],
            [
                'title'       => '5 Katha Land for Sale - Savar',
                'description' => 'সাভারে ৫ কাঠা আবাসিক জমি বিক্রি হবে। সকল কাগজপত্র সম্পূর্ণ। রাস্তার পাশে, সুন্দর লোকেশন।',
                'price'       => 5000000,
                'category'    => 'Property',
                'location'    => 'Dhaka, Savar',
                'is_featured' => false,
            ],

            // Electronics
            [
                'title'       => 'iPhone 14 Pro Max - 256GB Deep Purple',
                'description' => 'iPhone 14 Pro Max, 256GB, Deep Purple কালার। ১০০% ব্যাটারি হেলথ। সম্পূর্ণ বক্স সহ। কোনো স্ক্র্যাচ নেই।',
                'price'       => 125000,
                'category'    => 'Electronics',
                'location'    => 'Dhaka, Bashundhara',
                'is_featured' => true,
            ],
            [
                'title'       => 'Dell Inspiron 15 Laptop - Core i7',
                'description' => 'Dell Inspiron 15, Intel Core i7 12th Gen, 16GB RAM, 512GB SSD। গ্রাফিক্স ডিজাইন ও ভিডিও এডিটিং এর জন্য পারফেক্ট।',
                'price'       => 85000,
                'category'    => 'Electronics',
                'location'    => 'Dhaka, Elephant Road',
                'is_featured' => false,
            ],

            // Jobs
            [
                'title'       => 'Senior PHP Developer - Remote',
                'description' => 'আমরা একজন অভিজ্ঞ PHP/Laravel ডেভেলপার খুঁজছি। রিমোট কাজ। বেতন: ৫০,০০০-৮০,০০০ টাকা। অভিজ্ঞতা: ৩+ বছর।',
                'price'       => 80000,
                'category'    => 'Jobs',
                'location'    => 'Remote, Bangladesh',
                'is_featured' => true,
            ],
            [
                'title'       => 'Digital Marketing Executive - Mirpur',
                'description' => 'ডিজিটাল মার্কেটিং এক্সিকিউটিভ নিয়োগ। Facebook Ads, Google Ads, SEO এ অভিজ্ঞতা থাকতে হবে।',
                'price'       => 30000,
                'category'    => 'Jobs',
                'location'    => 'Dhaka, Mirpur',
                'is_featured' => false,
            ],

            // Education
            [
                'title'       => 'HSC Physics Private Tuition - Online',
                'description' => 'HSC Physics অনলাইন প্রাইভেট টিউশন। ঢাকা বিশ্ববিদ্যালয়ের পদার্থবিজ্ঞান বিভাগের শিক্ষার্থী দ্বারা পড়ানো হয়।',
                'price'       => 3000,
                'category'    => 'Education',
                'location'    => 'Online',
                'is_featured' => false,
            ],

            // Services
            [
                'title'       => 'AC Repair & Service - Home Visit',
                'description' => 'সকল ব্র্যান্ডের AC রিপেয়ার, সার্ভিসিং, গ্যাস চার্জ। বাসায় গিয়ে সার্ভিস দেওয়া হয়। অভিজ্ঞ টেকনিশিয়ান।',
                'price'       => 1500,
                'category'    => 'Services',
                'location'    => 'Dhaka',
                'is_featured' => true,
            ],

            // Fashion
            [
                'title'       => 'Original Leather Wallet - Premium Quality',
                'description' => 'আসল চামড়ার ওয়ালেট। প্রিমিয়াম কোয়ালিটি। ৬টি কার্ড স্লট, ২টি নোট সেকশন, ১টি কয়েন পকেট।',
                'price'       => 1200,
                'category'    => 'Fashion',
                'location'    => 'Dhaka, New Market',
                'is_featured' => false,
            ],

            // Furniture
            [
                'title'       => 'Office Desk & Chair Combo - Almost New',
                'description' => 'অফিস ডেস্ক ও চেয়ার কম্বো সেট। মাত্র ৩ মাস ব্যবহৃত। কাঠের ডেস্ক, আরামদায়ক চেয়ার।',
                'price'       => 8500,
                'category'    => 'Furniture',
                'location'    => 'Dhaka, Uttara',
                'is_featured' => false,
            ],

            // Pets
            [
                'title'       => 'Persian Cat - 6 Months Old',
                'description' => 'পার্সিয়ান ক্যাট, ৬ মাস বয়স, পাঞ্চ ফেস, সাদা কালার। ভ্যাক্সিনেশন কমপ্লিট। খুবই ফ্রেন্ডলি।',
                'price'       => 15000,
                'category'    => 'Pets & Animals',
                'location'    => 'Dhaka, Banani',
                'is_featured' => true,
            ],

            // Health
            [
                'title'       => 'Gym Equipment Set - Full Home Gym',
                'description' => 'হোম জিম সেট - ডাম্বেল, বারবেল, বেঞ্চ, পুল আপ বার সব আছে। ৬ মাস ব্যবহৃত।',
                'price'       => 25000,
                'category'    => 'Health & Beauty',
                'location'    => 'Dhaka, Mohammadpur',
                'is_featured' => false,
            ],

            // Sports
            [
                'title'       => 'Yamaha Acoustic Guitar - F310',
                'description' => 'Yamaha F310 অ্যাকুস্টিক গিটার। খুবই ভালো সাউন্ড কোয়ালিটি। ব্যাগ ফ্রি। নতুন স্ট্রিং লাগানো।',
                'price'       => 12000,
                'category'    => 'Sports & Hobbies',
                'location'    => 'Sylhet',
                'is_featured' => false,
            ],
        ];

        foreach ($listings as $item) {
            Listing::create([
                'user_id'     => $users[array_rand($users)],
                'category_id' => $categories[$item['category']] ?? 1,
                'title'       => $item['title'],
                'slug'        => Str::slug($item['title']) . '-' . uniqid(),
                'description' => $item['description'],
                'price'       => $item['price'],
                'location'    => $item['location'],
                'is_featured' => $item['is_featured'],
                'status'      => 'active',
                'views'       => rand(10, 500),
                'created_at'  => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}