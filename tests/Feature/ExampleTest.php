<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitor_showcase_page_loads_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('كلية العلوم - جامعة طرابلس');
        $response->assertSee('استفسر عن أي شيء');
    }

    public function test_visitor_can_submit_inquiry(): void
    {
        $department = Department::create([
            'name_ar' => 'قسم الحاسوب',
            'code' => 'CS',
        ]);

        $response = $this->post('/submit-inquiry', [
            'full_name' => 'محمد الفرجاني',
            'contact' => 'farjani@uot.edu.ly',
            'sender_type' => 'student',
            'department_id' => $department->id,
            'message' => 'استفسار بخصوص مواعيد تنزيل المقررات الدراسية لقسم الحاسوب.',
        ]);

        $response->assertRedirect('/#inquiry');
        $response->assertSessionHas('success_inquiry');
        $this->assertDatabaseHas('inquiries', [
            'full_name' => 'محمد الفرجاني',
            'email' => 'farjani@uot.edu.ly',
        ]);
    }

    public function test_admin_can_view_inquiries_dashboard(): void
    {
        Inquiry::create([
            'tracking_code' => 'UOT-SCI-2026-TEST',
            'full_name' => 'زائر تجريبي',
            'email' => 'visitor@test.com',
            'message' => 'سؤال حول شروط القبول والتسجيل.',
            'status' => 'new',
        ]);

        $response = $this->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('لوحة تحكم الإدارة');
        $response->assertSee('زائر تجريبي');
        $response->assertSee('UOT-SCI-2026-TEST');
    }

    public function test_admin_can_export_csv(): void
    {
        $response = $this->get('/admin/export');

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
    }
}
