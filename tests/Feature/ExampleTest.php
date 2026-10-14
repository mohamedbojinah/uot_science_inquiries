<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitor_showcase_page_loads_and_has_no_admin_links(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('كلية العلوم - جامعة طرابلس');
        $response->assertSee('استفسر عن أي شيء');
        // Assert that admin page link is NOT present on the visitor showcase page
        $response->assertDontSee('/admin');
        $response->assertDontSee('رابط الإدارة');
    }

    public function test_visitor_can_submit_inquiry_with_only_question(): void
    {
        // Only the message field is sent! All other fields are omitted / empty.
        $response = $this->post('/submit-inquiry', [
            'message' => 'هل يحق للطالب التقديم على إيقاف قيد في الفصل الدراسي الأول؟',
        ]);

        $response->assertRedirect('/#inquiry');
        $response->assertSessionHas('success_inquiry');
        
        // Assert stored in database with default 'زائر'
        $this->assertDatabaseHas('inquiries', [
            'full_name' => 'زائر',
            'message' => 'هل يحق للطالب التقديم على إيقاف قيد في الفصل الدراسي الأول؟',
        ]);
    }

    public function test_question_field_is_strictly_required(): void
    {
        // If message is missing, validation fails
        $response = $this->post('/submit-inquiry', [
            'full_name' => 'أحمد علي',
            'message' => '',
        ]);

        $response->assertSessionHasErrors(['message']);
    }

    public function test_admin_dashboard_is_accessible_directly(): void
    {
        Inquiry::create([
            'tracking_code' => 'UOT-SCI-2026-TEST',
            'full_name' => 'زائر غير معروف',
            'message' => 'سؤال حول شروط القبول والتسجيل.',
            'status' => 'new',
        ]);

        $response = $this->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('لوحة تحكم الإدارة');
        $response->assertSee('زائر غير معروف');
    }

    public function test_admin_can_delete_inquiry_and_sees_updated_message(): void
    {
        $inquiry = Inquiry::create([
            'tracking_code' => 'UOT-SCI-2026-DEL',
            'full_name' => 'زائر تجريبي',
            'message' => 'سؤال سيتم حذفه.',
            'status' => 'new',
        ]);

        $response = $this->delete("/admin/inquiries/{$inquiry->id}");

        $response->assertSessionHas('deleted', 'تم حذف الاستفسار بنجاح.');
        $this->assertDatabaseMissing('inquiries', ['id' => $inquiry->id]);
    }
}
