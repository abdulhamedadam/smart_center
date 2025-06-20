<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {


        // Get new category IDs to associate with products
        $webCategory = Category::where('slug->en', 'web-development')->first();
        $mobileCategory = Category::where('slug->en', 'mobile-app-development')->first();
        $cloudCategory = Category::where('slug->en', 'hosting-cloud')->first();
        $managementCategory = Category::where('slug->en', 'management-systems')->first();
        $educationCategory = Category::where('slug->en', 'educational-solutions')->first();
        $businessCategory = Category::where('slug->en', 'business-solutions')->first();
        $digitalCategory = Category::where('slug->en', 'digital-transformation')->first();
        $consultingCategory = Category::where('slug->en', 'software-consulting')->first();
        $customCategory = Category::where('slug->en', 'custom-solutions')->first();

        $products = [
            [
                'name' => [
                    'en' => 'Professional Website Development',
                    'ar' => 'تطوير موقع إلكتروني احترافي'
                ],
                'description' => [
                    'en' => 'Custom, responsive, and secure websites for your business or organization.',
                    'ar' => 'مواقع إلكترونية مخصصة ومتجاوبة وآمنة لعملك أو مؤسستك.'
                ],
                'price' => 2500.00,
                'stock_quantity' => 100,
                'views_count' => 0,
                'likes_count' => 0,
                'interests' => ['web', 'website', 'development'],
                'is_active' => true,
                'category_id' => $webCategory ? $webCategory->id : null
            ],
            [
                'name' => [
                    'en' => 'Mobile App (Android & iOS)',
                    'ar' => 'تطبيق جوال (أندرويد وiOS)'
                ],
                'description' => [
                    'en' => 'Native and cross-platform mobile app development for all business needs.',
                    'ar' => 'تطوير تطبيقات جوال أصلية وعبر المنصات لجميع احتياجات الأعمال.'
                ],
                'price' => 4000.00,
                'stock_quantity' => 100,
                'views_count' => 0,
                'likes_count' => 0,
                'interests' => ['mobile', 'app', 'android', 'ios'],
                'is_active' => true,
                'category_id' => $mobileCategory ? $mobileCategory->id : null
            ],
            [
                'name' => [
                    'en' => 'Cloud Hosting Package',
                    'ar' => 'باقة استضافة سحابية'
                ],
                'description' => [
                    'en' => 'Reliable and scalable cloud hosting for your digital projects.',
                    'ar' => 'استضافة سحابية موثوقة وقابلة للتوسع لمشاريعك الرقمية.'
                ],
                'price' => 500.00,
                'stock_quantity' => 100,
                'views_count' => 0,
                'likes_count' => 0,
                'interests' => ['cloud', 'hosting', 'server'],
                'is_active' => true,
                'category_id' => $cloudCategory ? $cloudCategory->id : null
            ],
            [
                'name' => [
                    'en' => 'ERP Management System',
                    'ar' => 'نظام إدارة موارد المؤسسات (ERP)'
                ],
                'description' => [
                    'en' => 'Integrated ERP system for managing all business operations efficiently.',
                    'ar' => 'نظام ERP متكامل لإدارة جميع عمليات الأعمال بكفاءة.'
                ],
                'price' => 8000.00,
                'stock_quantity' => 50,
                'views_count' => 0,
                'likes_count' => 0,
                'interests' => ['erp', 'management', 'system'],
                'is_active' => true,
                'category_id' => $managementCategory ? $managementCategory->id : null
            ],
            [
                'name' => [
                    'en' => 'E-Learning Platform',
                    'ar' => 'منصة تعليم إلكتروني'
                ],
                'description' => [
                    'en' => 'Smart e-learning platform for schools, academies, and training centers.',
                    'ar' => 'منصة تعليم إلكتروني ذكية للمدارس والأكاديميات ومراكز التدريب.'
                ],
                'price' => 6000.00,
                'stock_quantity' => 50,
                'views_count' => 0,
                'likes_count' => 0,
                'interests' => ['education', 'elearning', 'platform'],
                'is_active' => true,
                'category_id' => $educationCategory ? $educationCategory->id : null
            ],
            [
                'name' => [
                    'en' => 'Business Automation Solution',
                    'ar' => 'حل أتمتة الأعمال'
                ],
                'description' => [
                    'en' => 'Automate your business processes with advanced software solutions.',
                    'ar' => 'أتمت عمليات عملك مع حلول برمجية متقدمة.'
                ],
                'price' => 3500.00,
                'stock_quantity' => 100,
                'views_count' => 0,
                'likes_count' => 0,
                'interests' => ['business', 'automation', 'solution'],
                'is_active' => true,
                'category_id' => $businessCategory ? $businessCategory->id : null
            ],
            [
                'name' => [
                    'en' => 'Digital Transformation Package',
                    'ar' => 'باقة التحول الرقمي'
                ],
                'description' => [
                    'en' => 'Comprehensive digital transformation services for your business.',
                    'ar' => 'خدمات التحول الرقمي الشاملة لعملك.'
                ],
                'price' => 7000.00,
                'stock_quantity' => 100,
                'views_count' => 0,
                'likes_count' => 0,
                'interests' => ['digital', 'transformation', 'package'],
                'is_active' => true,
                'category_id' => $digitalCategory ? $digitalCategory->id : null
            ],
            [
                'name' => [
                    'en' => 'Software Consulting Session',
                    'ar' => 'جلسة استشارات برمجية'
                ],
                'description' => [
                    'en' => 'One-on-one software consulting to guide your digital projects.',
                    'ar' => 'استشارة برمجية فردية لإرشاد مشاريعك الرقمية.'
                ],
                'price' => 300.00,
                'stock_quantity' => 200,
                'views_count' => 0,
                'likes_count' => 0,
                'interests' => ['consulting', 'software', 'session'],
                'is_active' => true,
                'category_id' => $consultingCategory ? $consultingCategory->id : null
            ],
            [
                'name' => [
                    'en' => 'Custom Software Solution',
                    'ar' => 'حل برمجي مخصص'
                ],
                'description' => [
                    'en' => 'Tailored software built to fit your unique business requirements.',
                    'ar' => 'حل برمجي مصمم خصيصاً ليناسب متطلبات عملك.'
                ],
                'price' => 10000.00,
                'stock_quantity' => 20,
                'views_count' => 0,
                'likes_count' => 0,
                'interests' => ['custom', 'software', 'solution'],
                'is_active' => true,
                'category_id' => $customCategory ? $customCategory->id : null
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 