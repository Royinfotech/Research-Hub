<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SupabaseContactSync
{
    public function syncContact(array $data): void
    {
        $baseUrl = rtrim((string) config('services.supabase.url', ''), '/');
        $serviceRoleKey = (string) config('services.supabase.service_role_key', '');
        $table = (string) config('services.supabase.contacts_table', 'contacts');

        if ($baseUrl === '' || str_contains($baseUrl, 'your-project') || $serviceRoleKey === '' || str_contains($serviceRoleKey, 'your-service-role-key')) {
            return;
        }

        $payload = [
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'service' => $data['service'] ?? null,
            'message' => $data['message'] ?? null,
            'created_at' => now()->toIso8601String(),
        ];

        try {
            Http::timeout(10)
                ->acceptJson()
                ->withHeaders([
                    'apikey' => $serviceRoleKey,
                    'Authorization' => 'Bearer ' . $serviceRoleKey,
                    'Content-Type' => 'application/json',
                ])
                ->post($baseUrl . '/rest/v1/' . $table, $payload);
        } catch (\Throwable $e) {
            Log::warning('Supabase contact sync failed.', [
                'exception' => $e->getMessage(),
            ]);
        }
    }
}
