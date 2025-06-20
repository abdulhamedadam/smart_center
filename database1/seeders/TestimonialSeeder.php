<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => [
                    'en' => 'John Smith',
                    'ar' => 'جون سميث'
                ],
                'position' => [
                    'en' => 'CEO, Tech Solutions',
                    'ar' => 'الرئيس التنفيذي، حلول التقنية'
                ],
                'content' => [
                    'en' => 'Working with this team has been an absolute pleasure. Their attention to detail and commitment to quality is unmatched.',
                    'ar' => 'العمل مع هذا الفريق كان متعة مطلقة. اهتمامهم بالتفاصيل والتزامهم بالجودة لا مثيل له.'
                ],
                'status' => 1
            ],
            [
                'name' => [
                    'en' => 'Sarah Johnson',
                    'ar' => 'سارة جونسون'
                ],
                'position' => [
                    'en' => 'Marketing Director',
                    'ar' => 'مدير التسويق'
                ],
                'content' => [
                    'en' => 'The results we\'ve achieved together have exceeded our expectations. Their innovative approach and expertise made all the difference.',
                    'ar' => 'النتائج التي حققناها معًا تجاوزت توقعاتنا. نهجهم المبتكر وخبرتهم أحدثوا كل الفرق.'
                ],
                'status' => 1
            ],
            [
                'name' => [
                    'en' => 'Michael Brown',
                    'ar' => 'مايكل براون'
                ],
                'position' => [
                    'en' => 'Project Manager',
                    'ar' => 'مدير المشروع'
                ],
                'content' => [
                    'en' => 'Their professionalism and dedication to delivering quality work on time is impressive. I highly recommend their services.',
                    'ar' => 'احترافيتهم وتفانيهم في تقديم عمل عالي الجودة في الوقت المحدد مثير للإعجاب. أنصح بشدة بخدماتهم.'
                ],
                'status' => 1
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
} 