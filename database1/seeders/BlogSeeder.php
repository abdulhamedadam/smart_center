<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title' => [
                    'en' => 'The Importance of Digital Transformation for Businesses',
                    'ar' => 'أهمية التحول الرقمي للأعمال'
                ],
                'content' => [
                    'en' => "Digital transformation is no longer a luxury—it's a necessity for modern businesses. By adopting smart software solutions, companies can streamline operations, enhance customer experience, and stay ahead of the competition. At Progmaker, we help organizations embrace digital change with tailored systems that drive growth and efficiency.",
                    'ar' => "لم يعد التحول الرقمي رفاهية، بل أصبح ضرورة لكل الأعمال الحديثة. من خلال تبني الحلول البرمجية الذكية، يمكن للشركات تحسين عملياتها، وتعزيز تجربة العملاء، والبقاء في صدارة المنافسة. في بروج ميكر، نساعد المؤسسات على تبني التغيير الرقمي عبر أنظمة مخصصة تدعم النمو والكفاءة."
                ],
                'meta_title' => [
                    'en' => 'Digital Transformation Benefits',
                    'ar' => 'فوائد التحول الرقمي'
                ],
                'meta_description' => [
                    'en' => 'Discover why digital transformation is essential for business success and how Progmaker can help.',
                    'ar' => 'تعرف على أهمية التحول الرقمي لنجاح الأعمال وكيف يمكن لبروج ميكر مساعدتك.'
                ],
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'How to Choose the Right Software System for Your Company',
                    'ar' => 'كيف تختار النظام البرمجي المناسب لشركتك؟'
                ],
                'content' => [
                    'en' => "Selecting the right software system is crucial for your company's growth. Consider your business needs, scalability, integration capabilities, and support services. Progmaker offers expert consultation to help you identify and implement the best solutions tailored to your goals.",
                    'ar' => "اختيار النظام البرمجي المناسب أمر أساسي لنمو شركتك. ضع في اعتبارك احتياجات عملك، وقابلية التوسع، وإمكانيات التكامل، وخدمات الدعم. تقدم بروج ميكر استشارات احترافية لمساعدتك في تحديد وتنفيذ أفضل الحلول البرمجية التي تناسب أهدافك."
                ],
                'meta_title' => [
                    'en' => 'Choosing Business Software',
                    'ar' => 'اختيار البرمجيات للأعمال'
                ],
                'meta_description' => [
                    'en' => "Learn how to select the ideal software system for your business with Progmaker's guidance.",
                    'ar' => 'تعلم كيف تختار النظام البرمجي المثالي لعملك مع خبرة بروج ميكر.'
                ],
                'status' => 1
            ],
            [
                'title' => [
                    'en' => 'Why Progmaker Solutions Stand Out',
                    'ar' => 'لماذا حلول بروج ميكر مميزة؟'
                ],
                'content' => [
                    'en' => "Progmaker delivers innovative, reliable, and scalable software solutions for various sectors. Our team combines technical expertise with a deep understanding of business needs, ensuring every project is a success. Discover how our commitment to quality and customer satisfaction sets us apart.",
                    'ar' => "تقدم بروج ميكر حلولاً برمجية مبتكرة وموثوقة وقابلة للتوسع لمختلف القطاعات. يجمع فريقنا بين الخبرة التقنية وفهم عميق لاحتياجات الأعمال، لنضمن نجاح كل مشروع. اكتشف كيف تميزنا الجودة ورضا العملاء عن غيرنا."
                ],
                'meta_title' => [
                    'en' => 'Progmaker Software Advantages',
                    'ar' => 'مميزات برمجيات بروج ميكر'
                ],
                'meta_description' => [
                    'en' => "Explore the unique advantages of Progmaker's software solutions for your business.",
                    'ar' => 'اكتشف مميزات حلول بروج ميكر البرمجية لعملك.'
                ],
                'status' => 1
            ]
        ];

        foreach ($blogs as $blog) {
            $blog['slug'] = [
                'en' => Str::slug($blog['title']['en']),
                'ar' => Str::slug($blog['title']['ar'])
            ];
            Blog::create($blog);
        }
    }
} 