<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => [
                    'en' => 'E-commerce Website Redesign',
                    'ar' => 'إعادة تصميم موقع التجارة الإلكترونية'
                ],
                'description' => [
                    'en' => 'A complete redesign of an e-commerce platform focusing on user experience and modern design principles. The project included responsive design, improved navigation, and enhanced product presentation.',
                    'ar' => 'إعادة تصميم كاملة لمنصة التجارة الإلكترونية مع التركيز على تجربة المستخدم ومبادئ التصميم الحديثة. شمل المشروع تصميم متجاوب وتحسين التنقل وعرض منتجات محسن.'
                ],
                'meta_title' => [
                    'en' => 'E-commerce Website Redesign Project',
                    'ar' => 'مشروع إعادة تصميم موقع التجارة الإلكترونية'
                ],
                'meta_description' => [
                    'en' => 'Modern e-commerce website redesign project showcasing improved user experience and responsive design.',
                    'ar' => 'مشروع إعادة تصميم موقع تجارة إلكترونية حديث يعرض تحسين تجربة المستخدم والتصميم المتجاوب.'
                ],
                'project_link' => 'https://example.com/ecommerce-redesign',
                'view_num' => 1250,
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Mobile App Development',
                    'ar' => 'تطوير تطبيق الجوال'
                ],
                'description' => [
                    'en' => 'Development of a cross-platform mobile application for task management. Features include real-time synchronization, offline mode, and intuitive user interface.',
                    'ar' => 'تطوير تطبيق جوال متعدد المنصات لإدارة المهام. تتضمن الميزات المزامنة في الوقت الفعلي والوضع دون اتصال وواجهة مستخدم بديهية.'
                ],
                'meta_title' => [
                    'en' => 'Task Management Mobile App Project',
                    'ar' => 'مشروع تطبيق إدارة المهام للجوال'
                ],
                'meta_description' => [
                    'en' => 'Cross-platform mobile application development project for efficient task management.',
                    'ar' => 'مشروع تطوير تطبيق جوال متعدد المنصات لإدارة المهام بكفاءة.'
                ],
                'project_link' => 'https://example.com/mobile-app',
                'view_num' => 980,
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Corporate Website Development',
                    'ar' => 'تطوير موقع الشركة'
                ],
                'description' => [
                    'en' => 'Development of a modern corporate website with advanced features including multilingual support, blog system, and integrated contact forms.',
                    'ar' => 'تطوير موقع شركة حديث بميزات متقدمة تشمل دعم متعدد اللغات ونظام المدونة ونماذج الاتصال المدمجة.'
                ],
                'meta_title' => [
                    'en' => 'Modern Corporate Website Development',
                    'ar' => 'تطوير موقع شركة حديث'
                ],
                'meta_description' => [
                    'en' => 'Professional corporate website development project with multilingual support and modern features.',
                    'ar' => 'مشروع تطوير موقع شركة احترافي مع دعم متعدد اللغات وميزات حديثة.'
                ],
                'project_link' => 'https://example.com/corporate-website',
                'view_num' => 750,
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Portfolio Website Design',
                    'ar' => 'تصميم موقع المحفظة'
                ],
                'description' => [
                    'en' => 'Creative portfolio website design for a professional photographer. Features include a gallery system, booking system, and social media integration.',
                    'ar' => 'تصميم موقع محفظة إبداعي لمصور محترف. تتضمن الميزات نظام معرض ونظام حجز وتكامل مع وسائل التواصل الاجتماعي.'
                ],
                'meta_title' => [
                    'en' => 'Photography Portfolio Website Project',
                    'ar' => 'مشروع موقع محفظة التصوير'
                ],
                'meta_description' => [
                    'en' => 'Creative portfolio website design project for professional photography services.',
                    'ar' => 'مشروع تصميم موقع محفظة إبداعي لخدمات التصوير الاحترافية.'
                ],
                'project_link' => 'https://example.com/portfolio',
                'view_num' => 1500,
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Restaurant Management System',
                    'ar' => 'نظام إدارة المطعم'
                ],
                'description' => [
                    'en' => 'Development of a comprehensive restaurant management system including inventory management, order tracking, and customer relationship management.',
                    'ar' => 'تطوير نظام شامل لإدارة المطعم يشمل إدارة المخزون وتتبع الطلبات وإدارة علاقات العملاء.'
                ],
                'meta_title' => [
                    'en' => 'Restaurant Management System Development',
                    'ar' => 'تطوير نظام إدارة المطعم'
                ],
                'meta_description' => [
                    'en' => 'Complete restaurant management system development project with advanced features.',
                    'ar' => 'مشروع تطوير نظام إدارة مطعم كامل بميزات متقدمة.'
                ],
                'project_link' => 'https://example.com/restaurant-system',
                'view_num' => 890,
                'status' => 1
            ]
        ];

        foreach ($projects as $project) {
            $project['slug'] = [
                'en' => Str::slug($project['title']['en']),
                'ar' => Str::slug($project['title']['ar'])
            ];
            Project::create($project);
        }
    }
} 