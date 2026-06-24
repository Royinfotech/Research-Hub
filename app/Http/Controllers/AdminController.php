<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\IncomeTransaction;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Testimonial;
use App\Services\SimplePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        if ($request->password === env('ADMIN_PASSWORD', 'researchhub2026')) {
            Session::put('admin_authenticated', true);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['password' => 'Invalid admin password.']);
    }

    public function dashboard()
    {
        if (!Session::get('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $contacts = Contact::query()->latest()->paginate(5, ['*'], 'inquiries_page');
        $services = Service::query()->latest()->paginate(5, ['*'], 'services_page');
        $incomeTotal = IncomeTransaction::query()->sum('amount');
        $downpaymentTotal = IncomeTransaction::query()->where('payment_type', 'downpayment')->sum('amount');
        $fullPaymentTotal = IncomeTransaction::query()->where('payment_type', 'full_payment')->sum('amount');
        $testimonials = Testimonial::query()->latest()->take(10)->get();
        $portfolio = Portfolio::query()->latest()->take(10)->get();

        return view('admin.dashboard', compact('contacts', 'services', 'incomeTotal', 'downpaymentTotal', 'fullPaymentTotal', 'testimonials', 'portfolio'));
    }

    public function servicesIndex()
    {
        if (!Session::get('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $services = Service::query()
            ->orderBy('category')
            ->latest()
            ->paginate(8)
            ->withQueryString();
        $editingService = null;

        return view('admin.services', compact('services', 'editingService'));
    }

    public function storeService(Request $request)
    {
        if (!Session::get('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:research,website'],
            'description' => ['required', 'string', 'max:2000'],
            'price' => ['nullable', 'string', 'max:100'],
        ]);

        Service::create($validated);

        return redirect()->route('admin.services')->with('success', 'Service added successfully.');
    }

    public function exportServices()
    {
        if (!Session::get('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $services = Service::query()->orderBy('category')->orderBy('title')->get();
        $rows = [['Title', 'Category', 'Description', 'Price']];

        foreach ($services as $service) {
            $rows[] = [
                $service->title,
                $service->category,
                $service->description,
                $service->price,
            ];
        }

        $csv = collect($rows)->map(function (array $row) {
            return collect($row)->map(function ($value) {
                return '"'.str_replace('"', '""', (string) $value).'"';
            })->implode(',');
        })->implode("\n");

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="research-hub-services.csv"',
        ]);
    }

    public function editService(Service $service)
    {
        if (!Session::get('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $services = Service::query()
            ->orderBy('category')
            ->latest()
            ->paginate(8)
            ->withQueryString();
        $editingService = $service;

        return view('admin.services', compact('services', 'editingService'));
    }

    public function updateService(Request $request, Service $service)
    {
        if (!Session::get('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:research,website'],
            'description' => ['required', 'string', 'max:2000'],
            'price' => ['nullable', 'string', 'max:100'],
        ]);

        $service->update($validated);

        return redirect()->route('admin.services')->with('success', 'Service updated successfully.');
    }

    public function destroyService(Service $service)
    {
        if (!Session::get('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $service->delete();

        return redirect()->route('admin.services')->with('success', 'Service removed successfully.');
    }

    public function incomeStatement()
    {
        if (!Session::get('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        return view('admin.income', $this->incomeStatementData());
    }

    public function storeIncomeTransaction(Request $request)
    {
        if (!Session::get('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'service_name' => ['required', 'string', 'max:255', Rule::exists('services', 'title')],
            'payment_type' => ['required', 'in:downpayment,full_payment'],
            'amount' => ['required', 'numeric', 'min:0.01', 'max:999999999.99'],
            'paid_at' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        IncomeTransaction::create($validated);

        return redirect()->route('admin.income')->with('success', 'Income transaction recorded successfully.');
    }

    public function destroyIncomeTransaction(IncomeTransaction $incomeTransaction)
    {
        if (!Session::get('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $incomeTransaction->delete();

        return redirect()->route('admin.income')->with('success', 'Income transaction removed successfully.');
    }

    public function downloadIncomeStatement(SimplePdf $pdf)
    {
        if (!Session::get('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $data = $this->incomeStatementData(false);
        $lines = [
            'Generated: '.now()->format('F d, Y h:i A'),
            'Total Income: PHP '.number_format((float) $data['totalIncome'], 2),
            'Downpayments: PHP '.number_format((float) $data['downpaymentTotal'], 2),
            'Full Payments: PHP '.number_format((float) $data['fullPaymentTotal'], 2),
            '',
            str_pad('Date', 14).str_pad('Client', 22).str_pad('Service', 24).str_pad('Type', 15).'Amount',
            str_repeat('-', 88),
        ];

        foreach ($data['transactions'] as $transaction) {
            $lines[] = str_pad($transaction->paid_at->format('Y-m-d'), 14)
                .str_pad(substr($transaction->client_name, 0, 20), 22)
                .str_pad(substr($transaction->service_name, 0, 22), 24)
                .str_pad($transaction->payment_type === 'downpayment' ? 'Downpayment' : 'Full payment', 15)
                .'PHP '.number_format((float) $transaction->amount, 2);
        }

        return Response::make($pdf->renderTextReport('Research Hub Income Statement', $lines), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="income-statement.pdf"',
        ]);
    }

    private function incomeStatementData(bool $paginated = true): array
    {
        $baseQuery = IncomeTransaction::query()->latest('paid_at')->latest();
        $transactions = $paginated
            ? $baseQuery->paginate(10)->withQueryString()
            : $baseQuery->get();

        return [
            'transactions' => $transactions,
            'services' => Service::query()->orderBy('title')->get(),
            'totalIncome' => IncomeTransaction::query()->sum('amount'),
            'downpaymentTotal' => IncomeTransaction::query()->where('payment_type', 'downpayment')->sum('amount'),
            'fullPaymentTotal' => IncomeTransaction::query()->where('payment_type', 'full_payment')->sum('amount'),
        ];
    }

    public function logout()
    {
        Session::forget('admin_authenticated');

        return redirect()->route('home');
    }
}
