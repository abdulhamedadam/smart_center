<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            [
                'name' => [
                    'en' => 'Main Branch',
                    'ar' => 'الفرع الرئيسي'
                ],
                'address' => '123 Main Street, Downtown',
                'phone' => '+1 234 567 8900',
                'email' => 'main@example.com',
                'status' => Branch::STATUS_ACTIVE
            ],
            [
                'name' => [
                    'en' => 'North Branch',
                    'ar' => 'الفرع الشمالي'
                ],
                'address' => '456 North Avenue, Business District',
                'phone' => '+1 234 567 8901',
                'email' => 'north@example.com',
                'status' => Branch::STATUS_ACTIVE
            ],
            [
                'name' => [
                    'en' => 'South Branch',
                    'ar' => 'الفرع الجنوبي'
                ],
                'address' => '789 South Road, Commercial Area',
                'phone' => '+1 234 567 8902',
                'email' => 'south@example.com',
                'status' => Branch::STATUS_ACTIVE
            ],
            [
                'name' => [
                    'en' => 'East Branch',
                    'ar' => 'الفرع الشرقي'
                ],
                'address' => '321 East Boulevard, Shopping Center',
                'phone' => '+1 234 567 8903',
                'email' => 'east@example.com',
                'status' => Branch::STATUS_ACTIVE
            ],
            [
                'name' => [
                    'en' => 'West Branch',
                    'ar' => 'الفرع الغربي'
                ],
                'address' => '654 West Street, Business Park',
                'phone' => '+1 234 567 8904',
                'email' => 'west@example.com',
                'status' => Branch::STATUS_ACTIVE
            ]
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
} 