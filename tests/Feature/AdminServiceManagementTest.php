<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class AdminServiceManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_service_and_it_appears_on_public_pages(): void
    {
        Session::put('admin_authenticated', true);

        $response = $this->post('/admin/services', [
            'title' => 'Thesis Formatting',
            'category' => 'research',
            'description' => 'Professional formatting and citation support.',
            'price' => '₱2,500',
        ]);

        $response->assertRedirect(route('admin.services'));
        $this->assertDatabaseHas('services', [
            'title' => 'Thesis Formatting',
            'category' => 'research',
            'price' => '₱2,500',
        ]);

        $this->get('/services')->assertSee('Thesis Formatting');
        $this->get('/pricing')->assertSee('Thesis Formatting');
    }

    public function test_admin_can_export_services_as_csv(): void
    {
        Session::put('admin_authenticated', true);

        $this->post('/admin/services', [
            'title' => 'Research Editing',
            'category' => 'research',
            'description' => 'Detailed review and improvement.',
            'price' => 'PHP 1,500',
        ]);

        $response = $this->get('/admin/services/export');

        $response->assertOk();
        $this->assertStringStartsWith('text/csv', $response->headers->get('Content-Type'));
        $response->assertSee('Research Editing');
    }

    public function test_admin_can_record_income_and_download_statement_pdf(): void
    {
        Session::put('admin_authenticated', true);

        Service::create([
            'title' => 'Thesis Formatting',
            'category' => 'research',
            'description' => 'Professional formatting and citation support.',
            'price' => 'PHP 2,500',
        ]);

        $response = $this->post('/admin/income', [
            'client_name' => 'Jane Doe',
            'service_name' => 'Thesis Formatting',
            'payment_type' => 'downpayment',
            'amount' => '2500',
            'paid_at' => '2026-06-25',
            'notes' => 'Initial payment.',
        ]);

        $response->assertRedirect(route('admin.income'));
        $this->assertDatabaseHas('income_transactions', [
            'client_name' => 'Jane Doe',
            'service_name' => 'Thesis Formatting',
            'payment_type' => 'downpayment',
            'amount' => '2500.00',
        ]);

        $this->get('/admin/income')
            ->assertOk()
            ->assertSee('PHP 2,500.00')
            ->assertSee('Downpayment');

        $pdf = $this->get('/admin/income/report.pdf');

        $pdf->assertOk();
        $pdf->assertHeader('Content-Type', 'application/pdf');
        $this->assertStringStartsWith('%PDF', $pdf->getContent());
    }

    public function test_admin_cannot_record_income_for_a_service_not_in_catalog(): void
    {
        Session::put('admin_authenticated', true);

        $response = $this->post('/admin/income', [
            'client_name' => 'Jane Doe',
            'service_name' => 'Unknown Service',
            'payment_type' => 'downpayment',
            'amount' => '2500',
            'paid_at' => '2026-06-25',
        ]);

        $response->assertSessionHasErrors('service_name');
        $this->assertDatabaseMissing('income_transactions', [
            'service_name' => 'Unknown Service',
        ]);
    }
}
