<?php

namespace Tests\Feature;

use App\Mail\ResearchInquiryMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Transforming Ideas into Research Excellence and Digital Solutions');
    }

    public function test_contact_form_creates_inquiry_and_redirects(): void
    {
        Mail::fake();

        $response = $this->post('/contact', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '09123456789',
            'service' => 'Thesis Writing Assistance',
            'message' => 'I need support for my thesis.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'email' => 'jane@example.com',
            'service' => 'Thesis Writing Assistance',
        ]);

        Mail::assertSent(ResearchInquiryMail::class, function (ResearchInquiryMail $mail) {
            return $mail->hasTo(config('mail.to.address', env('MAIL_TO_ADDRESS', 'xd77company@gmail.com')))
                && $mail->hasFrom('jane@example.com')
                && $mail->hasReplyTo('jane@example.com');
        });
    }

    public function test_contact_form_prefills_selected_service_from_request_link(): void
    {
        $this->get('/contact?service=Statistical%20Analysis')
            ->assertOk()
            ->assertSee('value="Statistical Analysis"', false);
    }
}
