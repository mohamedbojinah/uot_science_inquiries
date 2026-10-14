-- ============================================================
-- Database Dump for Faculty of Science - University of Tripoli
-- Generated for Render Deployment
-- ============================================================

-- ------------------------------------------------------------
-- Table structure for `migrations`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE "migrations" ("id" integer primary key autoincrement not null, "migration" varchar not null, "batch" integer not null);

-- Dumping data for table `migrations`
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '0001_01_01_000000_create_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '0001_01_01_000001_create_cache_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '0001_01_01_000002_create_jobs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '2026_10_14_092412_add_details_to_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '2026_10_14_092412_create_departments_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2026_10_14_092412_create_inquiry_categories_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('7', '2026_10_14_092413_create_inquiries_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('8', '2026_10_14_092413_create_inquiry_logs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('9', '2026_10_14_092414_create_faqs_table', '1');

-- ------------------------------------------------------------
-- Table structure for `password_reset_tokens`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE "password_reset_tokens" ("email" varchar not null, "token" varchar not null, "created_at" datetime, primary key ("email"));

-- ------------------------------------------------------------
-- Table structure for `sessions`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE "sessions" ("id" varchar not null, "user_id" integer, "ip_address" varchar, "user_agent" text, "payload" text not null, "last_activity" integer not null, primary key ("id"));

-- Dumping data for table `sessions`
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('q8YH93V0WrSiNnTYXDAtRXG8pbz0y0HSIh7wsRHw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWFrN3ZHV0lWT21QRDdjNjViUXlxVGppc2ZWQmJ5eHRaaURwSXA4NiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo4OiJ2aXNpdG9ycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791972281');

-- ------------------------------------------------------------
-- Table structure for `cache`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE "cache" ("key" varchar not null, "value" text not null, "expiration" integer not null, primary key ("key"));

-- ------------------------------------------------------------
-- Table structure for `cache_locks`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE "cache_locks" ("key" varchar not null, "owner" varchar not null, "expiration" integer not null, primary key ("key"));

-- ------------------------------------------------------------
-- Table structure for `jobs`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE "jobs" ("id" integer primary key autoincrement not null, "queue" varchar not null, "payload" text not null, "attempts" integer not null, "reserved_at" integer, "available_at" integer not null, "created_at" integer not null);

-- ------------------------------------------------------------
-- Table structure for `job_batches`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE "job_batches" ("id" varchar not null, "name" varchar not null, "total_jobs" integer not null, "pending_jobs" integer not null, "failed_jobs" integer not null, "failed_job_ids" text not null, "options" text, "cancelled_at" integer, "created_at" integer not null, "finished_at" integer, primary key ("id"));

-- ------------------------------------------------------------
-- Table structure for `failed_jobs`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE "failed_jobs" ("id" integer primary key autoincrement not null, "uuid" varchar not null, "connection" text not null, "queue" text not null, "payload" text not null, "exception" text not null, "failed_at" datetime not null default CURRENT_TIMESTAMP);

-- ------------------------------------------------------------
-- Table structure for `users`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE "users" ("id" integer primary key autoincrement not null, "name" varchar not null, "email" varchar not null, "email_verified_at" datetime, "password" varchar not null, "remember_token" varchar, "created_at" datetime, "updated_at" datetime, "role" varchar not null default 'staff', "department_id" integer, "phone" varchar, "is_active" tinyint(1) not null default '1', foreign key("department_id") references "departments"("id") on delete set null);

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `department_id`, `phone`, `is_active`) VALUES ('1', 'إدارة كلية العلوم - المشرف العام', 'admin@uot.edu.ly', NULL, '$2y$12$TbEK7WA9FlzPYcYdXL4sGuOa7GyI2jEvlRYYKBwrBIZ/XUm1k49Zq', NULL, '2026-10-14 09:58:45', '2026-10-14 09:58:45', 'admin', '12', '+218 91 123 4567', '1');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `department_id`, `phone`, `is_active`) VALUES ('2', 'أ. منسق قسم الحاسوب', 'cs@uot.edu.ly', NULL, '$2y$12$Ry3UhwpnVcXGKoBnIWpHl.GSBv8BjTQD5mBMMdE3dkrIoF9/5PYSS', NULL, '2026-10-14 09:58:45', '2026-10-14 09:58:45', 'department_head', '1', '+218 92 234 5678', '1');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `department_id`, `phone`, `is_active`) VALUES ('3', 'مسجل كلية العلوم (الدراسة والامتحانات)', 'registrar@uot.edu.ly', NULL, '$2y$12$Lo02WDVFWXe7rayfmj5/Ue/ZFihqRklR0X3tRWzOtTG0yLFbzn.p2', NULL, '2026-10-14 09:58:46', '2026-10-14 09:58:46', 'staff', '10', '+218 91 876 5432', '1');

-- ------------------------------------------------------------
-- Table structure for `departments`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE "departments" ("id" integer primary key autoincrement not null, "name_ar" varchar not null, "name_en" varchar, "code" varchar not null, "description" text, "email" varchar, "phone" varchar, "office_location" varchar, "icon" varchar not null default 'bi-building', "is_active" tinyint(1) not null default '1', "created_at" datetime, "updated_at" datetime);

-- Dumping data for table `departments`
INSERT INTO `departments` (`id`, `name_ar`, `name_en`, `code`, `description`, `email`, `phone`, `office_location`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES ('1', 'قسم الحاسوب', 'Department of Computer Science', 'CS', 'يعنى بتدريس علوم البرمجيات، الشبكات، الذكاء الاصطناعي وهندسة النظم وتخريج كفاءات رقمية.', 'cs.science@uot.edu.ly', '+218 21 462 7801', 'مبنى كلية العلوم - الطابق الأول - جناح الحاسوب', 'bi-laptop', '1', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `departments` (`id`, `name_ar`, `name_en`, `code`, `description`, `email`, `phone`, `office_location`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES ('2', 'قسم الكيمياء', 'Department of Chemistry', 'CHEM', 'تطوير وتدريس العلوم الكيميائية العضوية وغير العضوية والتحليلية ومختبرات الأبحاث المتقدمة.', 'chem.science@uot.edu.ly', '+218 21 462 7802', 'مبنى الكيمياء والمختبرات المركزية', 'bi-radioactive', '1', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `departments` (`id`, `name_ar`, `name_en`, `code`, `description`, `email`, `phone`, `office_location`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES ('3', 'قسم الفيزياء', 'Department of Physics', 'PHYS', 'دراسة الفيزياء النظرية والتطبيقية، الطاقات المتجددة والإلكترونيات ومختبرات القياس الدقيق.', 'phys.science@uot.edu.ly', '+218 21 462 7803', 'مبنى كلية العلوم - الطابق الأرضي', 'bi-lightning-charge', '1', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `departments` (`id`, `name_ar`, `name_en`, `code`, `description`, `email`, `phone`, `office_location`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES ('4', 'قسم الرياضيات', 'Department of Mathematics', 'MATH', 'تدريس الرياضيات البحتة والتطبيقية والتحليل العددي والنماذج الرياضية.', 'math.science@uot.edu.ly', '+218 21 462 7804', 'مبنى كلية العلوم - الطابق الثاني', 'bi-calculator', '1', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `departments` (`id`, `name_ar`, `name_en`, `code`, `description`, `email`, `phone`, `office_location`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES ('5', 'قسم الإحصاء', 'Department of Statistics', 'STAT', 'تحليل البيانات، الإحصاء الحيوي، التنبؤات والبحوث الإحصائية المعتمدة.', 'stat.science@uot.edu.ly', '+218 21 462 7805', 'مبنى كلية العلوم - الطابق الثاني', 'bi-bar-chart-line', '1', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `departments` (`id`, `name_ar`, `name_en`, `code`, `description`, `email`, `phone`, `office_location`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES ('6', 'قسم علم النبات', 'Department of Botany', 'BOT', 'دراسة الفلورا الليبية، فسيولوجيا النبات، والتقنيات الحيوية الزراعية والبيئية.', 'bot.science@uot.edu.ly', '+218 21 462 7806', 'مبنى علوم الحياة والمعشبة النباتية', 'bi-flower1', '1', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `departments` (`id`, `name_ar`, `name_en`, `code`, `description`, `email`, `phone`, `office_location`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES ('7', 'قسم علم الحيوان', 'Department of Zoology', 'ZOO', 'دراسة التنوع الحيواني، علم وظائف الأعضاء، المناعة والميكروبيولوجيا الطبية والبيئية.', 'zoo.science@uot.edu.ly', '+218 21 462 7807', 'مبنى علوم الحياة - الطابق الأول', 'bi-bug', '1', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `departments` (`id`, `name_ar`, `name_en`, `code`, `description`, `email`, `phone`, `office_location`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES ('8', 'قسم علوم الأرض والجيولوجيا', 'Department of Earth Sciences & Geology', 'GEOL', 'دراسة الطبقات الأرضية، جيولوجيا النفط والمياه والمعادن والمتحجرات.', 'geol.science@uot.edu.ly', '+218 21 462 7808', 'مبنى الجيولوجيا ومتحف الصخور', 'bi-globe-americas', '1', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `departments` (`id`, `name_ar`, `name_en`, `code`, `description`, `email`, `phone`, `office_location`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES ('9', 'قسم الجيوفيزياء', 'Department of Geophysics', 'GEOPH', 'الاستكشاف الجيوفيزيائي، رصد الزلازل والمسوحات المغناطيسية والكهربائية للباطن الأرضي.', 'geophys.science@uot.edu.ly', '+218 21 462 7809', 'مبنى الجيولوجيا والجيوفيزياء', 'bi-activity', '1', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `departments` (`id`, `name_ar`, `name_en`, `code`, `description`, `email`, `phone`, `office_location`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES ('10', 'مكتب التسجيل والدراسة والامتحانات', 'Study & Exams and Registrar Office', 'REG', 'إدارة ملفات الطلاب الأكاديمية، تنزيل وتعديل المقررات، إعداد جداول الامتحانات والنتائج والشهادات.', 'registrar.science@uot.edu.ly', '+218 21 462 7810', 'الإدارة العامة لكلية العلوم - الطابق الأرضي', 'bi-journal-check', '1', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `departments` (`id`, `name_ar`, `name_en`, `code`, `description`, `email`, `phone`, `office_location`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES ('11', 'مكتب شؤون الطلاب', 'Student Affairs Office', 'STUD', 'رعاية الطلاب، الأنشطة الطلابية، بطاقات القيد والتعريف، الإرشاد وحل الصعوبات الطلابية.', 'students.science@uot.edu.ly', '+218 21 462 7811', 'مبنى الخدمات الطلابية - كلية العلوم', 'bi-people', '1', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `departments` (`id`, `name_ar`, `name_en`, `code`, `description`, `email`, `phone`, `office_location`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES ('12', 'عمادة كلية العلوم', 'Deanship of Faculty of Science', 'DEAN', 'الإدارة العليا للكلية، متابعة الجودة والاعتماد الأكاديمي، الشكاوى والمقترحات والقرارات العامة.', 'dean.science@uot.edu.ly', '+218 21 462 7800', 'المبنى الإداري الرئيسي - الطابق الثاني', 'bi-award', '1', '2026-10-14 09:58:45', '2026-10-14 09:58:45');

-- ------------------------------------------------------------
-- Table structure for `inquiry_categories`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `inquiry_categories`;
CREATE TABLE "inquiry_categories" ("id" integer primary key autoincrement not null, "name_ar" varchar not null, "name_en" varchar, "icon" varchar not null default 'bi-tag', "description" text, "is_active" tinyint(1) not null default '1', "display_order" integer not null default '0', "created_at" datetime, "updated_at" datetime);

-- Dumping data for table `inquiry_categories`
INSERT INTO `inquiry_categories` (`id`, `name_ar`, `name_en`, `icon`, `description`, `is_active`, `display_order`, `created_at`, `updated_at`) VALUES ('1', 'التسجيل وتنزيل المواد وتعديل القيد', 'Course Registration & Add/Drop', 'bi-card-checklist', 'كل ما يتعلق بإضافة وحذف المقررات، إيقاف القيد، رفع الحظر الأكاديمي وتجاوز السقف المحدد.', '1', '1', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `inquiry_categories` (`id`, `name_ar`, `name_en`, `icon`, `description`, `is_active`, `display_order`, `created_at`, `updated_at`) VALUES ('2', 'الجداول والامتحانات والنتائج', 'Schedules, Exams & Results', 'bi-calendar3', 'الاستفسار عن مواعيد الامتحانات النصفية والنهائية، تعارض القاعات، وإجراءات الطعون في الدرجات.', '1', '2', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `inquiry_categories` (`id`, `name_ar`, `name_en`, `icon`, `description`, `is_active`, `display_order`, `created_at`, `updated_at`) VALUES ('3', 'وثائق التخرج وكشوف الدرجات والإفادات', 'Transcripts & Graduation Documents', 'bi-file-earmark-pdf', 'طلب إفادات النجاح والتخرج، كشف الدرجات المصدق باللغة العربية والإنجليزية، وشهادات إتمام المقررات.', '1', '3', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `inquiry_categories` (`id`, `name_ar`, `name_en`, `icon`, `description`, `is_active`, `display_order`, `created_at`, `updated_at`) VALUES ('4', 'معادلة المقررات ونقل القيد بين الأقسام والجامعات', 'Course Equivalency & Student Transfer', 'bi-arrow-left-right', 'إجراءات الانتقال من وإلى كلية العلوم بجامعة طرابلس، أو التحويل بين الأقسام العلمية والمعادلات.', '1', '4', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `inquiry_categories` (`id`, `name_ar`, `name_en`, `icon`, `description`, `is_active`, `display_order`, `created_at`, `updated_at`) VALUES ('5', 'القبول والتسجيل للطلبة المستجدين', 'Freshmen Admission & Registration', 'bi-person-plus', 'متطلبات القبول وشروط الالتحاق بالأقسام، إجراءات المقابلة الشخصية وتنسيب المرحلة التمهيدية.', '1', '5', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `inquiry_categories` (`id`, `name_ar`, `name_en`, `icon`, `description`, `is_active`, `display_order`, `created_at`, `updated_at`) VALUES ('6', 'مشاريع التخرج والتدريب والبحوث العلمية', 'Graduation Projects & Research', 'bi-mortarboard', 'توزيع المشرفين الأكاديميين، مواعيد تسليم مشاريع التخرج، وحجز المختبرات للأبحاث.', '1', '6', '2026-10-14 09:58:45', '2026-10-14 09:58:45');
INSERT INTO `inquiry_categories` (`id`, `name_ar`, `name_en`, `icon`, `description`, `is_active`, `display_order`, `created_at`, `updated_at`) VALUES ('7', 'مقترحات وشكاوى واستفسارات عامة', 'Feedback, Complaints & Inquiries', 'bi-chat-heart', 'مساحة مفتوحة للطلاب والزوار لإبداء الملاحظات والمقترحات والشكاوى الموجهة مباشرة لعمادة الكلية.', '1', '7', '2026-10-14 09:58:45', '2026-10-14 09:58:45');

-- ------------------------------------------------------------
-- Table structure for `inquiries`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `inquiries`;
CREATE TABLE "inquiries" ("id" integer primary key autoincrement not null, "tracking_code" varchar not null, "sender_type" varchar not null default 'student', "full_name" varchar default 'زائر', "national_id_or_student_id" varchar, "email" varchar, "phone" varchar, "department_id" integer, "category_id" integer, "priority" varchar not null default 'normal', "subject" varchar, "message" text not null, "attachment_path" varchar, "attachment_name" varchar, "status" varchar not null default 'new', "reply_message" text, "replied_by_user_id" integer, "replied_at" datetime, "internal_notes" text, "is_public_faq" tinyint(1) not null default '0', "faq_question" varchar, "faq_answer" text, "viewed_by_student_at" datetime, "ip_address" varchar, "created_at" datetime, "updated_at" datetime, foreign key("department_id") references "departments"("id") on delete set null, foreign key("category_id") references "inquiry_categories"("id") on delete set null, foreign key("replied_by_user_id") references "users"("id") on delete set null);

-- Dumping data for table `inquiries`
INSERT INTO `inquiries` (`id`, `tracking_code`, `sender_type`, `full_name`, `national_id_or_student_id`, `email`, `phone`, `department_id`, `category_id`, `priority`, `subject`, `message`, `attachment_path`, `attachment_name`, `status`, `reply_message`, `replied_by_user_id`, `replied_at`, `internal_notes`, `is_public_faq`, `faq_question`, `faq_answer`, `viewed_by_student_at`, `ip_address`, `created_at`, `updated_at`) VALUES ('1', 'UOT-SCI-2026-CS894', 'student', 'أحمد طارق الفرجاني', '22104598', 'ahmed.farjani@student.uot.edu.ly', '+218 91 345 6789', '1', '1', 'urgent', 'مشكلة تعارض موعد امتحان مقرر برمجة 2 مع خوارزميات', 'السلام عليكم ورحمة الله، أود الإبلاغ عن وجود تعارض في الجدول النهائي لموعد امتحان مقرر برمجة 2 ومقرر خوارزميات، حيث أن كلا الامتحانين تم جدولتهما يوم الإثنين 2026/11/02 في نفس التوقيت (الفترة الصباحية)، نرجو النظر وتعديل التوقيت حتى نتمكن من الحضور.', NULL, NULL, 'answered', 'وعليكم السلام ورحمة الله وبركاته، مرحباً بك أحمد. تم التنسيق مع لجنة الامتحانات وتم تعديل موعد امتحان مقرر برمجة 2 ليكون في الفترة المسائية (الساعة 1:30 ظهراً) بنفس اليوم بقاعة 14. تم نشر الجدول المعدل على لوحة الإعلانات بالقسم وبوابة الموقع. بالتوفيق والنجاح.', '2', '2026-10-13 09:58:46', NULL, '0', NULL, NULL, NULL, NULL, '2026-10-14 09:58:46', '2026-10-14 09:58:46');
INSERT INTO `inquiries` (`id`, `tracking_code`, `sender_type`, `full_name`, `national_id_or_student_id`, `email`, `phone`, `department_id`, `category_id`, `priority`, `subject`, `message`, `attachment_path`, `attachment_name`, `status`, `reply_message`, `replied_by_user_id`, `replied_at`, `internal_notes`, `is_public_faq`, `faq_question`, `faq_answer`, `viewed_by_student_at`, `ip_address`, `created_at`, `updated_at`) VALUES ('2', 'UOT-SCI-2026-CH312', 'student', 'سارة مسعود الورفلي', '21908812', 'sara.elwerfelli@student.uot.edu.ly', '+218 92 789 1234', '2', '6', 'normal', 'طلب تصريح استخدام مختبر التحليل الطيفي لمشروع التخرج', 'تحية طيبة لإدارة قسم الكيمياء، أحتاج إلى تصريح رسمي لحجز واستخدام جهاز مقياس الطيف الضوئي UV-Vis لإجراء تحاليل عينات مشروع التخرج في الكيمياء التطبيقية، وذلك تحت إشراف الدكتورة المشرفة.', NULL, NULL, 'in_review', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2026-10-14 09:58:46', '2026-10-14 09:58:46');
INSERT INTO `inquiries` (`id`, `tracking_code`, `sender_type`, `full_name`, `national_id_or_student_id`, `email`, `phone`, `department_id`, `category_id`, `priority`, `subject`, `message`, `attachment_path`, `attachment_name`, `status`, `reply_message`, `replied_by_user_id`, `replied_at`, `internal_notes`, `is_public_faq`, `faq_question`, `faq_answer`, `viewed_by_student_at`, `ip_address`, `created_at`, `updated_at`) VALUES ('3', 'UOT-SCI-2026-RG770', 'alumnus', 'محمد عمر البوعيشي', '21503411', 'mohammed.bouaishi@gmail.com', '+218 94 456 7890', '10', '3', 'normal', 'الاستفسار عن جاهزية كشف الدرجات المصدق باللغة الإنجليزية', 'السلام عليكم، قمت بتقديم طلب استخراج كشف درجات إنجليزي مصدق قبل 10 أيام بغرض التقديم لمنحة دراسية، وأردت التأكد هل المعاملة جاهزة للاستلام من مكتب الخريجين؟ وشكراً جزيلاً.', NULL, NULL, 'new', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2026-10-14 09:58:46', '2026-10-14 09:58:46');

-- ------------------------------------------------------------
-- Table structure for `inquiry_logs`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `inquiry_logs`;
CREATE TABLE "inquiry_logs" ("id" integer primary key autoincrement not null, "inquiry_id" integer not null, "user_id" integer, "action" varchar not null, "title" varchar not null, "details" text, "created_at" datetime, "updated_at" datetime, foreign key("inquiry_id") references "inquiries"("id") on delete cascade, foreign key("user_id") references "users"("id") on delete set null);

-- Dumping data for table `inquiry_logs`
INSERT INTO `inquiry_logs` (`id`, `inquiry_id`, `user_id`, `action`, `title`, `details`, `created_at`, `updated_at`) VALUES ('1', '1', NULL, 'created', 'تم إنشاء الاستفسار بنجاح', 'تم استلام الاستفسار من أحمد طارق الفرجاني وتعيينه لقسم قسم الحاسوب', '2026-10-12 09:58:46', '2026-10-14 09:58:46');
INSERT INTO `inquiry_logs` (`id`, `inquiry_id`, `user_id`, `action`, `title`, `details`, `created_at`, `updated_at`) VALUES ('2', '1', '2', 'replied', 'تم الرد على الاستفسار', 'تمت مراجعة الاستفسار وتقديم الرد الرسمي من قبل إدارة القسم.', '2026-10-13 09:58:46', '2026-10-14 09:58:46');
INSERT INTO `inquiry_logs` (`id`, `inquiry_id`, `user_id`, `action`, `title`, `details`, `created_at`, `updated_at`) VALUES ('3', '2', NULL, 'created', 'تم إنشاء الاستفسار بنجاح', 'تم استلام الاستفسار من سارة مسعود الورفلي وتعيينه لقسم قسم الكيمياء', '2026-10-14 03:58:46', '2026-10-14 09:58:46');
INSERT INTO `inquiry_logs` (`id`, `inquiry_id`, `user_id`, `action`, `title`, `details`, `created_at`, `updated_at`) VALUES ('4', '3', NULL, 'created', 'تم إنشاء الاستفسار بنجاح', 'تم استلام الاستفسار من محمد عمر البوعيشي وتعيينه لقسم مكتب التسجيل والدراسة والامتحانات', '2026-10-14 07:58:46', '2026-10-14 09:58:46');

-- ------------------------------------------------------------
-- Table structure for `faqs`
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `faqs`;
CREATE TABLE "faqs" ("id" integer primary key autoincrement not null, "department_id" integer, "category_id" integer, "question" text not null, "answer" text not null, "views_count" integer not null default '0', "helpful_count" integer not null default '0', "is_published" tinyint(1) not null default '1', "display_order" integer not null default '0', "created_at" datetime, "updated_at" datetime, foreign key("department_id") references "departments"("id") on delete set null, foreign key("category_id") references "inquiry_categories"("id") on delete set null);

-- Dumping data for table `faqs`
INSERT INTO `faqs` (`id`, `department_id`, `category_id`, `question`, `answer`, `views_count`, `helpful_count`, `is_published`, `display_order`, `created_at`, `updated_at`) VALUES ('1', '10', '1', 'ما هو الحد الأدنى والأقصى للوحدات الدراسية المسموح بتنزيلها في الفصل الدراسي؟', 'الحد الأدنى لتنزيل الوحدات هو 12 وحدة دراسية والحد الأقصى هو 18 وحدة دراسية في الفصول الاعتيادية (خريف/ربيع). يمكن للطالب الخريج رفع السقف إلى 21 وحدة دراسية بعد موافقة المرشد الأكاديمي ومسجل الكلية.', '342', '129', '1', '1', '2026-10-14 09:58:46', '2026-10-14 09:58:46');
INSERT INTO `faqs` (`id`, `department_id`, `category_id`, `question`, `answer`, `views_count`, `helpful_count`, `is_published`, `display_order`, `created_at`, `updated_at`) VALUES ('2', '10', '3', 'كيف يمكنني استخراج إفادة تخرج أو كشف درجات مصدق باللغتين العربية والإنجليزية؟', 'يتم تقديم الطلب عبر مكتب شؤون الخريجين بكلية العلوم مصحوباً بـ: صورة من إخلاء الطرف، صورتين شخصيتين حديثتين، ورسوم استخراج الوثائق المقررة. تستغرق المعاملة الرسمية من 3 إلى 5 أيام عمل لاستلام النسخ المعتمدة.', '450', '210', '1', '2', '2026-10-14 09:58:46', '2026-10-14 09:58:46');
INSERT INTO `faqs` (`id`, `department_id`, `category_id`, `question`, `answer`, `views_count`, `helpful_count`, `is_published`, `display_order`, `created_at`, `updated_at`) VALUES ('3', '1', '4', 'ما هي شروط وإجراءات التحويل الداخلي إلى قسم الحاسوب من قسم علمي آخر؟', 'يشترط للتحويل إلى قسم الحاسوب: أن يكون الطالب قد اجتاز المقررات العامة (رياضيات 1، فيزياء 1، مقدمة حاسوب) بمعدل عام تراكمي لا يقل عن جيد (65%)، وتوفر مقاعد شاغرة بالقسم في بداية كل فصل دراسي بعد موافقة رئيسي القسمين.', '280', '95', '1', '3', '2026-10-14 09:58:46', '2026-10-14 09:58:46');
INSERT INTO `faqs` (`id`, `department_id`, `category_id`, `question`, `answer`, `views_count`, `helpful_count`, `is_published`, `display_order`, `created_at`, `updated_at`) VALUES ('4', '10', '2', 'ما هي الخطوات المتبعة لتقديم طعن في ورقة الامتحان النهائي؟', 'يحق للطالب تقديم طلب مراجعة خلال مدة أقصاها أسبوع واحد من تاريخ إعلان النتائج الرسمية، وذلك بتعبئة نموذج الطعن بمكتب الدراسة والامتحانات، حيث تشكل لجنة خاصة لمراجعة وتدقيق ورقة الإجابة مع أستاذ المقرر ورئيس القسم.', '195', '64', '1', '4', '2026-10-14 09:58:46', '2026-10-14 09:58:46');
INSERT INTO `faqs` (`id`, `department_id`, `category_id`, `question`, `answer`, `views_count`, `helpful_count`, `is_published`, `display_order`, `created_at`, `updated_at`) VALUES ('5', '11', '5', 'أين يقع مكتب شؤون الطلاب وما هي مواعيد العمل واستقبال المراجعين؟', 'يقع مكتب شؤون الطلاب في الدور الأرضي بالمبنى الإداري لكلية العلوم (مجمع الكليات العلمية - باب العكرمي/جامعة طرابلس)، ويستقبل الطلاب يومياً من الأحد إلى الخميس من الساعة 9:00 صباحاً حتى الساعة 2:00 ظهراً.', '150', '52', '1', '5', '2026-10-14 09:58:46', '2026-10-14 09:58:46');

