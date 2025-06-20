<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'title' => [
                    'en' => 'Progmaker - Software Experts',
                    'ar' => 'بروج ميكر - خبراء البرمجيات'
                ],
                'description' => [
                    'en' => 'At Progmaker, we create integrated software solutions tailored to your business needs, supporting your digital growth. Extensive experience in custom software and smart systems development.',
                    'ar' => 'نحن في بروج ميكر نبتكر حلولاً برمجية متكاملة تلبي احتياجات عملك وتدعم نموك الرقمي. خبرة واسعة في تطوير البرمجيات المخصصة والأنظمة الذكية.'
                ],
                'link' => 'https://progmaker.com/about',
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Specialized Systems for Every Sector',
                    'ar' => 'أنظمة متخصصة لكل قطاع'
                ],
                'description' => [
                    'en' => 'We offer a range of smart systems: Academic Management, Educational Records, Law Firm Management, LMS, Laboratory Management, Educational Platforms, and ERP systems.',
                    'ar' => 'نقدم مجموعة من الأنظمة الذكية: إدارة الأكاديميات، السجلات التعليمية، إدارة المحاماة، أنظمة LMS، إدارة المعامل، المنصات التعليمية، وأنظمة ERP.'
                ],
                'link' => 'https://progmaker.com/solutions',
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Our Competitive Advantages',
                    'ar' => 'مميزاتنا التنافسية'
                ],
                'description' => [
                    'en' => 'Continuous technical support, tailored solutions, fast delivery, and competitive pricing. We are committed to quality and innovation in every project.',
                    'ar' => 'دعم فني متواصل، حلول مخصصة، سرعة في التنفيذ، وأسعار تنافسية. نلتزم بالجودة والابتكار في كل مشروع.'
                ],
                'link' => 'https://progmaker.com/advantages',
                'status' => 1
            ]
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
} 