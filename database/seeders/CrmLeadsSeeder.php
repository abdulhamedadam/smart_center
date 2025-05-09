<?php

namespace Database\Seeders;

use App\Models\CrmLeads;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrmLeadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $arabicNames = [
            'محمد أحمد',
            'أحمد علي',
            'عمر خالد',
            'خالد حسن',
            'محمود عبدالله',
            'عبدالله إبراهيم',
            'إبراهيم محمد',
            'يوسف كمال',
            'كمال رضا',
            'رضا وائل'
        ];
        $courses = \App\Models\Courses::pluck('id')->toArray();
        $users = \App\Models\User::pluck('id')->toArray();

        $sources = ['website', 'social', 'referral', 'advertisement', 'other'];
        $statuses = [1, 2, 3, 4];

        foreach ($arabicNames as $name) {
            CrmLeads::create([
                'name' => $name,
                'phone' => '9665' . rand(10000000, 99999999),
                'email' => str_replace(' ', '.', $name) . '@example.com',
                'course_id' => $courses[array_rand($courses)] ?? null,
                'status' => $statuses[array_rand($statuses)],
                'source' => $sources[array_rand($sources)],
                'assigned_to' => $users[array_rand($users)] ?? null,
                'note' => 'تم إضافة هذا العميل من خلال السيدر',
                'created_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
