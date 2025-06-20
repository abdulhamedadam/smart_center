<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            [
                'title' => [
                    'en' => 'Ready-made Software Systems',
                    'ar' => 'أنظمة برمجية جاهزة'
                ],
                'description' => [
                    'en' => 'A wide range of ready-made systems for law firms, gyms, educational centers, labs, and more.',
                    'ar' => 'مجموعة واسعة من الأنظمة الجاهزة لمكاتب المحاماة، الجيمات، السناتر، المعامل، وغيرها.'
                ],
                'icon' => 'heroicon-o-cube',
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Custom Software Development',
                    'ar' => 'تطوير برمجيات مخصصة'
                ],
                'description' => [
                    'en' => 'Tailored software solutions to fit your business needs, from web to mobile and cloud.',
                    'ar' => 'حلول برمجية مصممة خصيصاً لتناسب احتياجات عملك، من الويب إلى الموبايل والسحابة.'
                ],
                'icon' => 'heroicon-o-sparkles',
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Technical Support & Consultation',
                    'ar' => 'دعم فني واستشارات'
                ],
                'description' => [
                    'en' => 'Ongoing support, training, and IT consultation for all our clients in Egypt, Saudi Arabia, Iraq, and Lebanon.',
                    'ar' => 'دعم مستمر، تدريب، واستشارات تقنية لجميع عملائنا في مصر والسعودية والعراق ولبنان.'
                ],
                'icon' => 'heroicon-o-shield-check',
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Digital Transformation',
                    'ar' => 'التحول الرقمي'
                ],
                'description' => [
                    'en' => 'Helping businesses move to digital with cloud, automation, and e-services.',
                    'ar' => 'مساعدة الشركات على التحول الرقمي عبر السحابة والأتمتة والخدمات الإلكترونية.'
                ],
                'icon' => 'heroicon-o-home-modern',
                'status' => 1
            ]
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
} 