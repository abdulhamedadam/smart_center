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
                'name' => [
                    'en' => 'Web Development',
                    'ar' => 'برمجة الويب'
                ],
                'slug' => [
                    'en' => 'web-development',
                    'ar' => 'برمجة-الويب'
                ],
                'description' => [
                    'en' => 'Professional web development services for businesses and organizations.',
                    'ar' => 'خدمات برمجة مواقع احترافية للشركات والمؤسسات.'
                ],
                'meta_title' => [
                    'en' => 'Web Development Services',
                    'ar' => 'خدمات برمجة الويب'
                ],
                'meta_description' => [
                    'en' => 'Build your online presence with modern and secure web solutions.',
                    'ar' => 'ابنِ حضورك الرقمي مع حلول ويب حديثة وآمنة.'
                ],
                'status' => Category::STATUS_ACTIVE
            ],
            [
                'name' => [
                    'en' => 'Mobile App Development',
                    'ar' => 'برمجة تطبيقات الجوال'
                ],
                'slug' => [
                    'en' => 'mobile-app-development',
                    'ar' => 'برمجة-تطبيقات-الجوال'
                ],
                'description' => [
                    'en' => 'Custom mobile app development for Android and iOS platforms.',
                    'ar' => 'تطوير تطبيقات جوال مخصصة لمنصات أندرويد وiOS.'
                ],
                'meta_title' => [
                    'en' => 'Mobile App Solutions',
                    'ar' => 'حلول تطبيقات الجوال'
                ],
                'meta_description' => [
                    'en' => 'Reach your customers everywhere with innovative mobile apps.',
                    'ar' => 'وصل لعملائك في كل مكان مع تطبيقات جوال مبتكرة.'
                ],
                'status' => Category::STATUS_ACTIVE
            ],
            [
                'name' => [
                    'en' => 'Hosting & Cloud',
                    'ar' => 'الاستضافة والحوسبة السحابية'
                ],
                'slug' => [
                    'en' => 'hosting-cloud',
                    'ar' => 'الاستضافة-والحوسبة-السحابية'
                ],
                'description' => [
                    'en' => 'Reliable hosting and cloud solutions for your business.',
                    'ar' => 'حلول استضافة وحوسبة سحابية موثوقة لعملك.'
                ],
                'meta_title' => [
                    'en' => 'Hosting & Cloud Services',
                    'ar' => 'خدمات الاستضافة والحوسبة السحابية'
                ],
                'meta_description' => [
                    'en' => 'Secure and scalable hosting for your digital projects.',
                    'ar' => 'استضافة آمنة وقابلة للتوسع لمشاريعك الرقمية.'
                ],
                'status' => Category::STATUS_ACTIVE
            ],
            [
                'name' => [
                    'en' => 'Management Systems',
                    'ar' => 'الأنظمة الإدارية'
                ],
                'slug' => [
                    'en' => 'management-systems',
                    'ar' => 'الأنظمة-الإدارية'
                ],
                'description' => [
                    'en' => 'Integrated management systems for various business sectors.',
                    'ar' => 'أنظمة إدارية متكاملة لمختلف القطاعات.'
                ],
                'meta_title' => [
                    'en' => 'Business Management Systems',
                    'ar' => 'أنظمة إدارة الأعمال'
                ],
                'meta_description' => [
                    'en' => 'Boost your efficiency with smart management solutions.',
                    'ar' => 'عزز كفاءتك مع حلول إدارة ذكية.'
                ],
                'status' => Category::STATUS_ACTIVE
            ],
            [
                'name' => [
                    'en' => 'Educational Solutions',
                    'ar' => 'الحلول التعليمية'
                ],
                'slug' => [
                    'en' => 'educational-solutions',
                    'ar' => 'الحلول-التعليمية'
                ],
                'description' => [
                    'en' => 'Smart educational platforms and e-learning systems.',
                    'ar' => 'منصات تعليمية ذكية وأنظمة تعلم إلكتروني.'
                ],
                'meta_title' => [
                    'en' => 'E-Learning & Education',
                    'ar' => 'التعليم الإلكتروني والتعليم'
                ],
                'meta_description' => [
                    'en' => 'Empower education with modern digital tools.',
                    'ar' => 'طور التعليم بأدوات رقمية حديثة.'
                ],
                'status' => Category::STATUS_ACTIVE
            ],
            [
                'name' => [
                    'en' => 'Business Solutions',
                    'ar' => 'حلول الأعمال'
                ],
                'slug' => [
                    'en' => 'business-solutions',
                    'ar' => 'حلول-الأعمال'
                ],
                'description' => [
                    'en' => 'Comprehensive business solutions for growth and success.',
                    'ar' => 'حلول أعمال شاملة للنمو والنجاح.'
                ],
                'meta_title' => [
                    'en' => 'Business Solutions',
                    'ar' => 'حلول الأعمال'
                ],
                'meta_description' => [
                    'en' => 'Drive your business forward with innovative solutions.',
                    'ar' => 'ادفع عملك للأمام مع حلول مبتكرة.'
                ],
                'status' => Category::STATUS_ACTIVE
            ],
            [
                'name' => [
                    'en' => 'Digital Transformation',
                    'ar' => 'التحول الرقمي'
                ],
                'slug' => [
                    'en' => 'digital-transformation',
                    'ar' => 'التحول-الرقمي'
                ],
                'description' => [
                    'en' => 'Digital transformation services for future-ready businesses.',
                    'ar' => 'خدمات التحول الرقمي للأعمال المواكبة للمستقبل.'
                ],
                'meta_title' => [
                    'en' => 'Digital Transformation',
                    'ar' => 'التحول الرقمي'
                ],
                'meta_description' => [
                    'en' => 'Transform your business with digital innovation.',
                    'ar' => 'حوّل عملك بالابتكار الرقمي.'
                ],
                'status' => Category::STATUS_ACTIVE
            ],
            [
                'name' => [
                    'en' => 'Software Consulting',
                    'ar' => 'الاستشارات البرمجية'
                ],
                'slug' => [
                    'en' => 'software-consulting',
                    'ar' => 'الاستشارات-البرمجية'
                ],
                'description' => [
                    'en' => 'Expert software consulting for your digital projects.',
                    'ar' => 'استشارات برمجية احترافية لمشاريعك الرقمية.'
                ],
                'meta_title' => [
                    'en' => 'Software Consulting',
                    'ar' => 'الاستشارات البرمجية'
                ],
                'meta_description' => [
                    'en' => 'Get the right advice for your software journey.',
                    'ar' => 'احصل على الاستشارة الصحيحة لمسارك البرمجي.'
                ],
                'status' => Category::STATUS_ACTIVE
            ],
            [
                'name' => [
                    'en' => 'Custom Solutions',
                    'ar' => 'حلول مخصصة'
                ],
                'slug' => [
                    'en' => 'custom-solutions',
                    'ar' => 'حلول-مخصصة'
                ],
                'description' => [
                    'en' => 'Tailored software solutions to fit your unique needs.',
                    'ar' => 'حلول برمجية مصممة خصيصاً لتناسب احتياجاتك.'
                ],
                'meta_title' => [
                    'en' => 'Custom Software Solutions',
                    'ar' => 'حلول برمجية مخصصة'
                ],
                'meta_description' => [
                    'en' => 'Achieve your goals with custom-built software.',
                    'ar' => 'حقق أهدافك مع برمجيات مصممة خصيصاً.'
                ],
                'status' => Category::STATUS_ACTIVE
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        
    }
} 