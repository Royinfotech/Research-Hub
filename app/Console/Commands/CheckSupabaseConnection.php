<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckSupabaseConnection extends Command
{
    protected $signature = 'supabase:check {--table=contacts : The table to verify}';

    protected $description = 'Verify that Supabase credentials are configured and the target table is reachable.';

    public function handle(): int
    {
        $baseUrl = rtrim((string) config('services.supabase.url', ''), '/');
        $serviceRoleKey = (string) config('services.supabase.service_role_key', '');
        $table = $this->option('table') ?: config('services.supabase.contacts_table', 'contacts');

        if ($baseUrl === '' || str_contains($baseUrl, 'your-project') || $serviceRoleKey === '' || str_contains($serviceRoleKey, 'your-service-role-key')) {
            $this->error('Supabase credentials are not configured. Update your .env file first.');

            return self::FAILURE;
        }

        $response = Http::acceptJson()
            ->withHeaders([
                'apikey' => $serviceRoleKey,
                'Authorization' => 'Bearer ' . $serviceRoleKey,
            ])
            ->get($baseUrl . '/rest/v1/' . $table . '?select=id&limit=1');

        if ($response->successful()) {
            $this->info("Supabase is reachable and the '{$table}' table is available.");

            return self::SUCCESS;
        }

        if ($response->status() === 404) {
            $this->error("Supabase is reachable, but the '{$table}' table was not found.");
            $this->line('Run the SQL from database/supabase/create_contacts_table.sql in the Supabase SQL editor.');

            return self::FAILURE;
        }

        $this->error('Supabase check failed with status ' . $response->status() . ': ' . $response->body());

        return self::FAILURE;
    }
}
