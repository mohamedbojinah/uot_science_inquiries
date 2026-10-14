<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Inquiry;
use App\Models\InquiryCategory;
use App\Models\InquiryLog;
use App\Models\Faq;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Departments of Faculty of Science - University of Tripoli
        $departmentsData = [
            [
                'name_ar' => 'قسم الرياضيات',
                'name_en' => 'Department of Mathematics',
                'code' => 'MATH',
                'description' => 'تدريس الرياضيات البحتة والتطبيقية والتحليل العددي والنماذج الرياضية.',
                'email' => 'math.science@uot.edu.ly',
                'phone' => '+218 21 462 7804',
                'office_location' => 'مبنى كلية العلوم - الطابق الثاني',
                'icon' => 'bi-calculator',
            ],
            [
                'name_ar' => 'قسم الحاسوب',
                'name_en' => 'Department of Computer Science',
                'code' => 'CS',
                'description' => 'يعنى بتدريس علوم البرمجيات، الشبكات، الذكاء الاصطناعي وهندسة النظم وتخريج كفاءات رقمية.',
                'email' => 'cs.science@uot.edu.ly',
                'phone' => '+218 21 462 7801',
                'office_location' => 'مبنى كلية العلوم - الطابق الأول - جناح الحاسوب',
                'icon' => 'bi-laptop',
            ],
            [
                'name_ar' => 'قسم الكيمياء',
                'name_en' => 'Department of Chemistry',
                'code' => 'CHEM',
                'description' => 'تطوير وتدريس العلوم الكيميائية العضوية وغير العضوية والتحليلية ومختبرات الأبحاث المتقدمة.',
                'email' => 'chem.science@uot.edu.ly',
                'phone' => '+218 21 462 7802',
                'office_location' => 'مبنى الكيمياء والمختبرات المركزية',
                'icon' => 'bi-radioactive',
            ],
            [
                'name_ar' => 'قسم الفيزياء',
                'name_en' => 'Department of Physics',
                'code' => 'PHYS',
                'description' => 'دراسة الفيزياء النظرية والتطبيقية، الطاقات المتجددة والإلكترونيات ومختبرات القياس الدقيق.',
                'email' => 'phys.science@uot.edu.ly',
                'phone' => '+218 21 462 7803',
                'office_location' => 'مبنى كلية العلوم - الطابق الأرضي',
                'icon' => 'bi-lightning-charge',
            ],
            [
                'name_ar' => 'قسم الإحصاء',
                'name_en' => 'Department of Statistics',
                'code' => 'STAT',
                'description' => 'تحليل البيانات، الإحصاء الحيوي، التنبؤات والبحوث الإحصائية المعتمدة.',
                'email' => 'stat.science@uot.edu.ly',
                'phone' => '+218 21 462 7805',
                'office_location' => 'مبنى كلية العلوم - الطابق الثاني',
                'icon' => 'bi-bar-chart-line',
            ],
            [
                'name_ar' => 'قسم علم النبات',
                'name_en' => 'Department of Botany',
                'code' => 'BOT',
                'description' => 'دراسة الفلورا الليبية، فسيولوجيا النبات، والتقنيات الحيوية الزراعية والبيئية.',
                'email' => 'bot.science@uot.edu.ly',
                'phone' => '+218 21 462 7806',
                'office_location' => 'مبنى علوم الحياة والمعشبة النباتية',
                'icon' => 'bi-flower1',
            ],
            [
                'name_ar' => 'قسم علم الحيوان',
                'name_en' => 'Department of Zoology',
                'code' => 'ZOO',
                'description' => 'دراسة التنوع الحيواني، علم وظائف الأعضاء، المناعة والميكروبيولوجيا الطبية والبيئية.',
                'email' => 'zoo.science@uot.edu.ly',
                'phone' => '+218 21 462 7807',
                'office_location' => 'مبنى علوم الحياة - الطابق الأول',
                'icon' => 'bi-bug',
            ],
            [
                'name_ar' => 'قسم علوم الأرض والجيولوجيا',
                'name_en' => 'Department of Earth Sciences & Geology',
                'code' => 'GEOL',
                'description' => 'دراسة الطبقات الأرضية، جيولوجيا النفط والمياه والمعادن والمتحجرات.',
                'email' => 'geol.science@uot.edu.ly',
                'phone' => '+218 21 462 7808',
                'office_location' => 'مبنى الجيولوجيا ومتحف الصخور',
                'icon' => 'bi-globe-americas',
            ],
            [
                'name_ar' => 'قسم الجيوفيزياء',
                'name_en' => 'Department of Geophysics',
                'code' => 'GEOPH',
                'description' => 'الاستكشاف الجيوفيزيائي، رصد الزلازل والمسوحات المغناطيسية والكهربائية للباطن الأرضي.',
                'email' => 'geophys.science@uot.edu.ly',
                'phone' => '+218 21 462 7809',
                'office_location' => 'مبنى الجيولوجيا والجيوفيزياء',
                'icon' => 'bi-activity',
            ],
            [
                'name_ar' => 'مكتب التسجيل والدراسة والامتحانات',
                'name_en' => 'Study & Exams and Registrar Office',
                'code' => 'REG',
                'description' => 'إدارة ملفات الطلاب الأكاديمية، تنزيل وتعديل المقررات، إعداد جداول الامتحانات والنتائج والشهادات.',
                'email' => 'registrar.science@uot.edu.ly',
                'phone' => '+218 21 462 7810',
                'office_location' => 'الإدارة العامة لكلية العلوم - الطابق الأرضي',
                'icon' => 'bi-journal-check',
            ],
            [
                'name_ar' => 'مكتب شؤون الطلاب',
                'name_en' => 'Student Affairs Office',
                'code' => 'STUD',
                'description' => 'رعاية الطلاب، الأنشطة الطلابية، بطاقات القيد والتعريف، الإرشاد وحل الصعوبات الطلابية.',
                'email' => 'students.science@uot.edu.ly',
                'phone' => '+218 21 462 7811',
                'office_location' => 'مبنى الخدمات الطلابية - كلية العلوم',
                'icon' => 'bi-people',
            ],
            [
                'name_ar' => 'عمادة كلية العلوم',
                'name_en' => 'Deanship of Faculty of Science',
                'code' => 'DEAN',
                'description' => 'الإدارة العليا للكلية، متابعة الجودة والاعتماد الأكاديمي، الشكاوى والمقترحات والقرارات العامة.',
                'email' => 'dean.science@uot.edu.ly',
                'phone' => '+218 21 462 7800',
                'office_location' => 'المبنى الإداري الرئيسي - الطابق الثاني',
                'icon' => 'bi-award',
            ],
        ];

        $departments = [];
        foreach ($departmentsData as $dep) {
            $departments[$dep['code']] = Department::updateOrCreate(
                ['code' => $dep['code']],
                $dep
            );
        }

        // 2. Inquiry Categories
        $categoriesData = [
            [
                'name_ar' => 'التسجيل وتنزيل المواد وتعديل القيد',
                'name_en' => 'Course Registration & Add/Drop',
                'icon' => 'bi-card-checklist',
                'description' => 'كل ما يتعلق بإضافة وحذف المقررات، إيقاف القيد، رفع الحظر الأكاديمي وتجاوز السقف المحدد.',
                'display_order' => 1,
            ],
            [
                'name_ar' => 'الجداول والامتحانات والنتائج',
                'name_en' => 'Schedules, Exams & Results',
                'icon' => 'bi-calendar3',
                'description' => 'الاستفسار عن مواعيد الامتحانات النصفية والنهائية، تعارض القاعات، وإجراءات الطعون في الدرجات.',
                'display_order' => 2,
            ],
            [
                'name_ar' => 'وثائق التخرج وكشوف الدرجات والإفادات',
                'name_en' => 'Transcripts & Graduation Documents',
                'icon' => 'bi-file-earmark-pdf',
                'description' => 'طلب إفادات النجاح والتخرج، كشف الدرجات المصدق باللغة العربية والإنجليزية، وشهادات إتمام المقررات.',
                'display_order' => 3,
            ],
            [
                'name_ar' => 'معادلة المقررات ونقل القيد بين الأقسام والجامعات',
                'name_en' => 'Course Equivalency & Student Transfer',
                'icon' => 'bi-arrow-left-right',
                'description' => 'إجراءات الانتقال من وإلى كلية العلوم بجامعة طرابلس، أو التحويل بين الأقسام العلمية والمعادلات.',
                'display_order' => 4,
            ],
            [
                'name_ar' => 'القبول والتسجيل للطلبة المستجدين',
                'name_en' => 'Freshmen Admission & Registration',
                'icon' => 'bi-person-plus',
                'description' => 'متطلبات القبول وشروط الالتحاق بالأقسام، إجراءات المقابلة الشخصية وتنسيب المرحلة التمهيدية.',
                'display_order' => 5,
            ],
            [
                'name_ar' => 'مشاريع التخرج والتدريب والبحوث العلمية',
                'name_en' => 'Graduation Projects & Research',
                'icon' => 'bi-mortarboard',
                'description' => 'توزيع المشرفين الأكاديميين، مواعيد تسليم مشاريع التخرج، وحجز المختبرات للأبحاث.',
                'display_order' => 6,
            ],
            [
                'name_ar' => 'مقترحات وشكاوى واستفسارات عامة',
                'name_en' => 'Feedback, Complaints & Inquiries',
                'icon' => 'bi-chat-heart',
                'description' => 'مساحة مفتوحة للطلاب والزوار لإبداء الملاحظات والمقترحات والشكاوى الموجهة مباشرة لعمادة الكلية.',
                'display_order' => 7,
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[] = InquiryCategory::updateOrCreate(
                ['name_ar' => $cat['name_ar']],
                $cat
            );
        }

        // 3. Admin & Staff Users
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@uot.edu.ly'],
            [
                'name' => 'إدارة كلية العلوم - المشرف العام',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'department_id' => $departments['DEAN']->id,
                'phone' => '+218 91 123 4567',
                'is_active' => true,
            ]
        );

        $csUser = User::updateOrCreate(
            ['email' => 'cs@uot.edu.ly'],
            [
                'name' => 'أ. منسق قسم الحاسوب',
                'password' => Hash::make('password123'),
                'role' => 'department_head',
                'department_id' => $departments['CS']->id,
                'phone' => '+218 92 234 5678',
                'is_active' => true,
            ]
        );

        $regUser = User::updateOrCreate(
            ['email' => 'registrar@uot.edu.ly'],
            [
                'name' => 'مسجل كلية العلوم (الدراسة والامتحانات)',
                'password' => Hash::make('password123'),
                'role' => 'staff',
                'department_id' => $departments['REG']->id,
                'phone' => '+218 91 876 5432',
                'is_active' => true,
            ]
        );

        // 4. Initial FAQs
        $faqsData = [
            [
                'department_id' => $departments['REG']->id,
                'category_id' => $categories[0]->id,
                'question' => 'ما هو الحد الأدنى والأقصى للوحدات الدراسية المسموح بتنزيلها في الفصل الدراسي؟',
                'answer' => 'الحد الأدنى لتنزيل الوحدات هو 12 وحدة دراسية والحد الأقصى هو 18 وحدة دراسية في الفصول الاعتيادية (خريف/ربيع). يمكن للطالب الخريج رفع السقف إلى 21 وحدة دراسية بعد موافقة المرشد الأكاديمي ومسجل الكلية.',
                'views_count' => 342,
                'helpful_count' => 129,
                'display_order' => 1,
            ],
            [
                'department_id' => $departments['REG']->id,
                'category_id' => $categories[2]->id,
                'question' => 'كيف يمكنني استخراج إفادة تخرج أو كشف درجات مصدق باللغتين العربية والإنجليزية؟',
                'answer' => 'يتم تقديم الطلب عبر مكتب شؤون الخريجين بكلية العلوم مصحوباً بـ: صورة من إخلاء الطرف، صورتين شخصيتين حديثتين، ورسوم استخراج الوثائق المقررة. تستغرق المعاملة الرسمية من 3 إلى 5 أيام عمل لاستلام النسخ المعتمدة.',
                'views_count' => 450,
                'helpful_count' => 210,
                'display_order' => 2,
            ],
            [
                'department_id' => $departments['CS']->id,
                'category_id' => $categories[3]->id,
                'question' => 'ما هي شروط وإجراءات التحويل الداخلي إلى قسم الحاسوب من قسم علمي آخر؟',
                'answer' => 'يشترط للتحويل إلى قسم الحاسوب: أن يكون الطالب قد اجتاز المقررات العامة (رياضيات 1، فيزياء 1، مقدمة حاسوب) بمعدل عام تراكمي لا يقل عن جيد (65%)، وتوفر مقاعد شاغرة بالقسم في بداية كل فصل دراسي بعد موافقة رئيسي القسمين.',
                'views_count' => 280,
                'helpful_count' => 95,
                'display_order' => 3,
            ],
            [
                'department_id' => $departments['REG']->id,
                'category_id' => $categories[1]->id,
                'question' => 'ما هي الخطوات المتبعة لتقديم طعن في ورقة الامتحان النهائي؟',
                'answer' => 'يحق للطالب تقديم طلب مراجعة خلال مدة أقصاها أسبوع واحد من تاريخ إعلان النتائج الرسمية، وذلك بتعبئة نموذج الطعن بمكتب الدراسة والامتحانات، حيث تشكل لجنة خاصة لمراجعة وتدقيق ورقة الإجابة مع أستاذ المقرر ورئيس القسم.',
                'views_count' => 195,
                'helpful_count' => 64,
                'display_order' => 4,
            ],
            [
                'department_id' => $departments['STUD']->id,
                'category_id' => $categories[4]->id,
                'question' => 'أين يقع مكتب شؤون الطلاب وما هي مواعيد العمل واستقبال المراجعين؟',
                'answer' => 'يقع مكتب شؤون الطلاب في الدور الأرضي بالمبنى الإداري لكلية العلوم (مجمع الكليات العلمية - باب العكرمي/جامعة طرابلس)، ويستقبل الطلاب يومياً من الأحد إلى الخميس من الساعة 9:00 صباحاً حتى الساعة 2:00 ظهراً.',
                'views_count' => 150,
                'helpful_count' => 52,
                'display_order' => 5,
            ],
        ];

        foreach ($faqsData as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }

        // 5. Sample Inquiries with realistic tracking codes
        $sampleInquiries = [
            [
                'tracking_code' => 'UOT-SCI-2026-CS894',
                'sender_type' => 'student',
                'full_name' => 'أحمد طارق الفرجاني',
                'national_id_or_student_id' => '22104598',
                'email' => 'ahmed.farjani@student.uot.edu.ly',
                'phone' => '+218 91 345 6789',
                'department_id' => $departments['CS']->id,
                'category_id' => $categories[0]->id,
                'priority' => 'urgent',
                'subject' => 'مشكلة تعارض موعد امتحان مقرر برمجة 2 مع خوارزميات',
                'message' => 'السلام عليكم ورحمة الله، أود الإبلاغ عن وجود تعارض في الجدول النهائي لموعد امتحان مقرر برمجة 2 ومقرر خوارزميات، حيث أن كلا الامتحانين تم جدولتهما يوم الإثنين 2026/11/02 في نفس التوقيت (الفترة الصباحية)، نرجو النظر وتعديل التوقيت حتى نتمكن من الحضور.',
                'status' => 'answered',
                'reply_message' => 'وعليكم السلام ورحمة الله وبركاته، مرحباً بك أحمد. تم التنسيق مع لجنة الامتحانات وتم تعديل موعد امتحان مقرر برمجة 2 ليكون في الفترة المسائية (الساعة 1:30 ظهراً) بنفس اليوم بقاعة 14. تم نشر الجدول المعدل على لوحة الإعلانات بالقسم وبوابة الموقع. بالتوفيق والنجاح.',
                'replied_by_user_id' => $csUser->id,
                'replied_at' => now()->subDay(),
                'created_at' => now()->subDays(2),
            ],
            [
                'tracking_code' => 'UOT-SCI-2026-CH312',
                'sender_type' => 'student',
                'full_name' => 'سارة مسعود الورفلي',
                'national_id_or_student_id' => '21908812',
                'email' => 'sara.elwerfelli@student.uot.edu.ly',
                'phone' => '+218 92 789 1234',
                'department_id' => $departments['CHEM']->id,
                'category_id' => $categories[5]->id,
                'priority' => 'normal',
                'subject' => 'طلب تصريح استخدام مختبر التحليل الطيفي لمشروع التخرج',
                'message' => 'تحية طيبة لإدارة قسم الكيمياء، أحتاج إلى تصريح رسمي لحجز واستخدام جهاز مقياس الطيف الضوئي UV-Vis لإجراء تحاليل عينات مشروع التخرج في الكيمياء التطبيقية، وذلك تحت إشراف الدكتورة المشرفة.',
                'status' => 'in_review',
                'reply_message' => null,
                'created_at' => now()->subHours(6),
            ],
            [
                'tracking_code' => 'UOT-SCI-2026-RG770',
                'sender_type' => 'alumnus',
                'full_name' => 'محمد عمر البوعيشي',
                'national_id_or_student_id' => '21503411',
                'email' => 'mohammed.bouaishi@gmail.com',
                'phone' => '+218 94 456 7890',
                'department_id' => $departments['REG']->id,
                'category_id' => $categories[2]->id,
                'priority' => 'normal',
                'subject' => 'الاستفسار عن جاهزية كشف الدرجات المصدق باللغة الإنجليزية',
                'message' => 'السلام عليكم، قمت بتقديم طلب استخراج كشف درجات إنجليزي مصدق قبل 10 أيام بغرض التقديم لمنحة دراسية، وأردت التأكد هل المعاملة جاهزة للاستلام من مكتب الخريجين؟ وشكراً جزيلاً.',
                'status' => 'new',
                'reply_message' => null,
                'created_at' => now()->subHours(2),
            ],
        ];

        foreach ($sampleInquiries as $item) {
            $created_at = $item['created_at'] ?? now();
            unset($item['created_at']);
            
            $inquiry = Inquiry::updateOrCreate(
                ['tracking_code' => $item['tracking_code']],
                $item
            );

            // Add creation log
            InquiryLog::firstOrCreate(
                ['inquiry_id' => $inquiry->id, 'action' => 'created'],
                [
                    'action' => 'created',
                    'title' => 'تم إنشاء الاستفسار بنجاح',
                    'details' => 'تم استلام الاستفسار من ' . $inquiry->full_name . ' وتعيينه لقسم ' . $inquiry->department->name_ar,
                    'created_at' => $created_at,
                ]
            );

            if ($inquiry->status === 'answered') {
                InquiryLog::firstOrCreate(
                    ['inquiry_id' => $inquiry->id, 'action' => 'replied'],
                    [
                        'action' => 'replied',
                        'user_id' => $inquiry->replied_by_user_id,
                        'title' => 'تم الرد على الاستفسار',
                        'details' => 'تمت مراجعة الاستفسار وتقديم الرد الرسمي من قبل إدارة القسم.',
                        'created_at' => $inquiry->replied_at ?? now(),
                    ]
                );
            }
        }
    }
}
