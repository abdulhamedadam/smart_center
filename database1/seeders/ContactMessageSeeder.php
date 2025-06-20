<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmed@example.com',
                'message' => 'مرحباً، أنا مهتم بالتعرف على خدماتكم في مجال تطوير المواقع. هل يمكنني الحصول على مزيد من المعلومات؟',
                'status' => ContactMessage::STATUS_UNREAD
            ],
            [
                'name' => 'سارة علي',
                'email' => 'sara@example.com',
                'message' => 'أود أن أعبر عن إعجابي بالتصميم الجذاب لموقعكم. هل تقدمون خدمات تصميم المواقع للشركات الصغيرة؟',
                'status' => ContactMessage::STATUS_READ
            ],
            [
                'name' => 'محمد خالد',
                'email' => 'mohammed@example.com',
                'message' => 'أنا أبحث عن شركة محترفة لتطوير تطبيق جوال لشركتي. هل يمكنكم مساعدتي في هذا المشروع؟',
                'status' => ContactMessage::STATUS_REPLIED
            ],
            [
                'name' => 'فاطمة عبدالله',
                'email' => 'fatima@example.com',
                'message' => 'أرغب في معرفة المزيد عن خدماتكم في مجال تحسين محركات البحث. هل يمكنكم تقديم استشارة مجانية؟',
                'status' => ContactMessage::STATUS_UNREAD
            ],
            [
                'name' => 'عمر حسن',
                'email' => 'omar@example.com',
                'message' => 'أنا معجب جداً بمشاريعكم السابقة. هل يمكنني الحصول على عرض سعر لتطوير موقع تجارة إلكترونية؟',
                'status' => ContactMessage::STATUS_READ
            ],
            [
                'name' => 'نورا محمود',
                'email' => 'noura@example.com',
                'message' => 'أود أن أستفسر عن إمكانية تطوير تطبيق ويب متقدم لشركتي. هل يمكنكم تقديم تفاصيل عن الخدمات المتاحة؟',
                'status' => ContactMessage::STATUS_UNREAD
            ],
            [
                'name' => 'خالد راشد',
                'email' => 'khaled@example.com',
                'message' => 'أنا مهتم بتجديد موقع شركتي. هل يمكنكم تقديم اقتراحات لتحسين تجربة المستخدم؟',
                'status' => ContactMessage::STATUS_REPLIED
            ],
            [
                'name' => 'ليلى أحمد',
                'email' => 'layla@example.com',
                'message' => 'أرغب في معرفة المزيد عن خدمات الصيانة والدعم الفني التي تقدمونها للمواقع. هل يمكنكم توضيح ذلك؟',
                'status' => ContactMessage::STATUS_READ
            ],
            [
                'name' => 'ياسر محمود',
                'email' => 'yasser@example.com',
                'message' => 'أنا أبحث عن شركة محترفة لتطوير نظام إدارة محتوى مخصص. هل يمكنكم مساعدتي في هذا المشروع؟',
                'status' => ContactMessage::STATUS_UNREAD
            ],
            [
                'name' => 'منى علي',
                'email' => 'mona@example.com',
                'message' => 'أود أن أستفسر عن إمكانية تطوير تطبيق جوال متوافق مع نظامي iOS و Android. هل يمكنكم تقديم تفاصيل عن الخدمات؟',
                'status' => ContactMessage::STATUS_READ
            ]
        ];

        foreach ($messages as $message) {
            ContactMessage::create($message);
        }
    }
} 