<?php

namespace App\Http\Controllers;

use App\Mail\ResearchInquiryMail;
use App\Models\Contact;
use App\Services\SupabaseContactSync;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct(protected SupabaseContactSync $supabaseContactSync)
    {
    }

    public function index(Request $request)
    {
        return view('contact', [
            'selectedService' => $request->query('service', ''),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'service' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Contact::create($validated);

        try {
            $this->supabaseContactSync->syncContact($validated);
        } catch (\Throwable $e) {
            Log::warning('Contact sync to Supabase was skipped after an error.', [
                'exception' => $e->getMessage(),
            ]);
        }

        Mail::to(config('mail.to.address', env('MAIL_TO_ADDRESS', 'xd77company@gmail.com')))
            ->send(new ResearchInquiryMail($validated));

        return redirect()->route('contact')->with('success', 'Your inquiry is received. We will contact you shortly.');
    }
}
