<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_submit_inquiry(): void
    {
        $response = $this->post('/submit-inquiry', [
            'full_name' => 'طالب تجريبي',
            'contact' => 'test@uot.edu.ly',
            'message' => 'هذا استفسار تجريبي للتأكد من عمل النظام بشكل ممتاز.',
        ]);

        $response->assertSessionHas('success_inquiry');
        $this->assertDatabaseHas('inquiries', [
            'full_name' => 'طالب تجريبي',
            'email' => 'test@uot.edu.ly',
        ]);
    }
}
