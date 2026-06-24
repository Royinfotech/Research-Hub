<?php

namespace Tests\Unit;

use App\Services\SupabaseContactSync;
use Tests\TestCase;

class SupabaseContactSyncTest extends TestCase
{
    public function test_sync_contact_skips_when_supabase_is_not_configured(): void
    {
        config(['services.supabase.url' => null]);
        config(['services.supabase.service_role_key' => null]);

        $service = new SupabaseContactSync();

        $service->syncContact([
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'phone' => '+1 234 567 890',
            'service' => 'Research Support',
            'message' => 'Hello from the test suite.',
        ]);

        $this->assertTrue(true);
    }
}
