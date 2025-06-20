<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            [
                'name' => [
                    'en' => 'Tech Solutions Inc.',
                    'ar' => 'تيك سوليوشنز'
                ],
                'status' => 1
            ],
            [
                'name' => [
                    'en' => 'Digital Innovations',
                    'ar' => 'الابتكارات الرقمية'
                ],
                'status' => 1
            ],
            [
                'name' => [
                    'en' => 'Global Systems',
                    'ar' => 'الأنظمة العالمية'
                ],
                'status' => 1
            ],
            [
                'name' => [
                    'en' => 'Smart Technologies',
                    'ar' => 'التقنيات الذكية'
                ],
                'status' => 1
            ],
            [
                'name' => [
                    'en' => 'Future Solutions',
                    'ar' => 'حلول المستقبل'
                ],
                'status' => 1
            ]
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
} 