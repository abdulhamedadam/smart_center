<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => [
                    'en' => 'Web Development',
                    'ar' => 'تطوير مواقع الويب'
                ],
                'description' => [
                    'en' => 'Professional web development services for businesses and organizations, including custom websites, e-commerce, and portals.',
                    'ar' => 'خدمات تطوير مواقع ويب احترافية للشركات والمؤسسات، تشمل المواقع المخصصة والمتاجر الإلكترونية والبورتالات.'
                ],
                'meta_title' => [
                    'en' => 'Web Development Services',
                    'ar' => 'خدمات تطوير مواقع الويب'
                ],
                'meta_description' => [
                    'en' => 'Build your online presence with modern, secure, and responsive websites.',
                    'ar' => 'ابنِ حضورك الرقمي مع مواقع حديثة وآمنة ومتجاوبة.'
                ],
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Mobile App Development',
                    'ar' => 'تطوير تطبيقات الجوال'
                ],
                'description' => [
                    'en' => 'Custom mobile app development for Android and iOS platforms, tailored to your business needs.',
                    'ar' => 'تطوير تطبيقات جوال مخصصة لمنصات أندرويد وiOS، مصممة حسب احتياجات عملك.'
                ],
                'meta_title' => [
                    'en' => 'Mobile App Solutions',
                    'ar' => 'حلول تطبيقات الجوال'
                ],
                'meta_description' => [
                    'en' => 'Reach your customers everywhere with innovative mobile apps.',
                    'ar' => 'وصل لعملائك في كل مكان مع تطبيقات جوال مبتكرة.'
                ],
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Hosting & Cloud Services',
                    'ar' => 'خدمات الاستضافة والحوسبة السحابية'
                ],
                'description' => [
                    'en' => 'Reliable hosting and cloud solutions for your digital projects, with high security and scalability.',
                    'ar' => 'حلول استضافة وحوسبة سحابية موثوقة لمشاريعك الرقمية، مع أمان عالي وقابلية للتوسع.'
                ],
                'meta_title' => [
                    'en' => 'Hosting & Cloud',
                    'ar' => 'الاستضافة والحوسبة السحابية'
                ],
                'meta_description' => [
                    'en' => 'Secure and scalable hosting for your business.',
                    'ar' => 'استضافة آمنة وقابلة للتوسع لعملك.'
                ],
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Management Systems Development',
                    'ar' => 'تطوير الأنظمة الإدارية'
                ],
                'description' => [
                    'en' => 'Integrated management systems (ERP, HR, CRM, etc.) to streamline your business operations.',
                    'ar' => 'أنظمة إدارية متكاملة (ERP، الموارد البشرية، إدارة العملاء...) لتسهيل عمليات عملك.'
                ],
                'meta_title' => [
                    'en' => 'Business Management Systems',
                    'ar' => 'أنظمة إدارة الأعمال'
                ],
                'meta_description' => [
                    'en' => 'Boost your efficiency with smart management solutions.',
                    'ar' => 'عزز كفاءتك مع حلول إدارة ذكية.'
                ],
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'E-Learning Platform Development',
                    'ar' => 'تطوير منصات التعليم الإلكتروني'
                ],
                'description' => [
                    'en' => 'Smart e-learning platforms and educational solutions for schools, academies, and training centers.',
                    'ar' => 'منصات تعليم إلكتروني ذكية وحلول تعليمية للمدارس والأكاديميات ومراكز التدريب.'
                ],
                'meta_title' => [
                    'en' => 'E-Learning Solutions',
                    'ar' => 'حلول التعليم الإلكتروني'
                ],
                'meta_description' => [
                    'en' => 'Empower education with modern digital tools.',
                    'ar' => 'طور التعليم بأدوات رقمية حديثة.'
                ],
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Business Solutions',
                    'ar' => 'حلول الأعمال الذكية'
                ],
                'description' => [
                    'en' => 'Comprehensive business solutions for automation, analytics, and growth.',
                    'ar' => 'حلول أعمال شاملة للأتمتة والتحليل والنمو.'
                ],
                'meta_title' => [
                    'en' => 'Business Solutions',
                    'ar' => 'حلول الأعمال'
                ],
                'meta_description' => [
                    'en' => 'Drive your business forward with innovative solutions.',
                    'ar' => 'ادفع عملك للأمام مع حلول مبتكرة.'
                ],
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Digital Transformation',
                    'ar' => 'التحول الرقمي'
                ],
                'description' => [
                    'en' => 'Comprehensive digital transformation services to modernize your business and processes.',
                    'ar' => 'خدمات التحول الرقمي الشاملة لتحديث عملك وعملياتك.'
                ],
                'meta_title' => [
                    'en' => 'Digital Transformation',
                    'ar' => 'التحول الرقمي'
                ],
                'meta_description' => [
                    'en' => 'Transform your business with digital innovation.',
                    'ar' => 'حوّل عملك بالابتكار الرقمي.'
                ],
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Software Consulting',
                    'ar' => 'الاستشارات البرمجية'
                ],
                'description' => [
                    'en' => 'Expert software consulting to guide your digital projects and technology choices.',
                    'ar' => 'استشارات برمجية احترافية لإرشاد مشاريعك الرقمية واختياراتك التقنية.'
                ],
                'meta_title' => [
                    'en' => 'Software Consulting',
                    'ar' => 'الاستشارات البرمجية'
                ],
                'meta_description' => [
                    'en' => 'Get the right advice for your software journey.',
                    'ar' => 'احصل على الاستشارة الصحيحة لمسارك البرمجي.'
                ],
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Custom Software Solutions',
                    'ar' => 'حلول برمجية مخصصة'
                ],
                'description' => [
                    'en' => 'Tailored software solutions to fit your unique business requirements.',
                    'ar' => 'حلول برمجية مصممة خصيصاً لتناسب متطلبات عملك.'
                ],
                'meta_title' => [
                    'en' => 'Custom Software Solutions',
                    'ar' => 'حلول برمجية مخصصة'
                ],
                'meta_description' => [
                    'en' => 'Achieve your goals with custom-built software.',
                    'ar' => 'حقق أهدافك مع برمجيات مصممة خصيصاً.'
                ],
                'status' => 1
            ]
        ];

        foreach ($services as $service) {
            $service['slug'] = [
                'en' => Str::slug($service['title']['en']),
                'ar' => Str::slug($service['title']['ar'])
            ];
            Service::create($service);
        }
    }
} 