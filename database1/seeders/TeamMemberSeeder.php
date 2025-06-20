<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => [
                    'en' => 'Mahmoud Sobhy',
                    'ar' => 'محمود صبحي'
                ],
                'position' => [
                    'en' => 'Chief Executive Officer',
                    'ar' => 'الرئيس التنفيذي'
                ],
                'facebook' => '',
                'x' => '',
                'linkedin' => '',
                'whatsapp' => '',
                'status' => 1
            ],
            [
                'name' => [
                    'en' => 'Abdelhamid Zaghloul',
                    'ar' => 'عبدالحميد زغلول'
                ],
                'position' => [
                    'en' => 'Technical Director',
                    'ar' => 'المدير التقني'
                ],
                'facebook' => '',
                'x' => '',
                'linkedin' => '',
                'whatsapp' => '',
                'status' => 1
            ],
            [
                'name' => [
                    'en' => 'Basem Hossam',
                    'ar' => 'باسم حسام'
                ],
                'position' => [
                    'en' => 'Backend Developer',
                    'ar' => 'مطور Backend'
                ],
                'facebook' => '',
                'x' => '',
                'linkedin' => '',
                'whatsapp' => '',
                'status' => 1
            ],
            [
                'name' => [
                    'en' => 'Noor Mohamed',
                    'ar' => 'نور محمد'
                ],
                'position' => [
                    'en' => 'Marketing',
                    'ar' => 'التسويق'
                ],
                'facebook' => '',
                'x' => '',
                'linkedin' => '',
                'whatsapp' => '',
                'status' => 1
            ],
            [
                'name' => [
                    'en' => 'Abdelalim',
                    'ar' => 'عبدالعليم'
                ],
                'position' => [
                    'en' => 'UI/UX Designer',
                    'ar' => 'مصمم UI/UX'
                ],
                'facebook' => '',
                'x' => '',
                'linkedin' => '',
                'whatsapp' => '',
                'status' => 1
            ]
        ];

        foreach ($teamMembers as $teamMember) {
            TeamMember::create($teamMember);
        }
    }
} 