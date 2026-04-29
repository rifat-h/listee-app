<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name'      => 'Admin',
            'email'     => 'admin@listee.com',
            'password'  => Hash::make('password123'),
            'phone'     => '01700000000',
            'about'     => 'Listee Admin - Classified Ads Platform',
            'is_admin'  => true,
            'email_verified_at' => now(),
        ]);

        // Demo Users
        $users = [
            [
                'name'  => 'Rahim Uddin',
                'email' => 'rahim@demo.com',
                'phone' => '01711111111',
                'about' => 'আমি একজন ব্যবসায়ী। গাড়ি ও ইলেকট্রনিক্স বিক্রি করি।',
            ],
            [
                'name'  => 'Fatema Begum',
                'email' => 'fatema@demo.com',
                'phone' => '01722222222',
                'about' => 'ফ্যাশন ও হোম ডেকোর প্রেমী।',
            ],
            [
                'name'  => 'Karim Sheikh',
                'email' => 'karim@demo.com',
                'phone' => '01733333333',
                'about' => 'রিয়েল এস্টেট এজেন্ট। বাড়ি ও ফ্ল্যাট কেনাবেচা।',
            ],
            [
                'name'  => 'Nasreen Akter',
                'email' => 'nasreen@demo.com',
                'phone' => '01744444444',
                'about' => 'টিউটর। অনলাইন ও অফলাইনে পড়াই।',
            ],
            [
                'name'  => 'Jamal Hossain',
                'email' => 'jamal@demo.com',
                'phone' => '01755555555',
                'about' => 'ফ্রিল্যান্সার ও ওয়েব ডেভেলপার।',
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name'      => $user['name'],
                'email'     => $user['email'],
                'password'  => Hash::make('password123'),
                'phone'     => $user['phone'],
                'about'     => $user['about'],
                'is_admin'  => false,
                'email_verified_at' => now(),
            ]);
        }
    }
}