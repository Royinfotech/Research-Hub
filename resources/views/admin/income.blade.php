@extends('layouts.app')

@section('content')
<div class="py-8 lg:py-10">
    <div class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:flex-row lg:items-center lg:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#008CBA]">Admin Report</p>
            <h1 class="mt-2 text-3xl font-semibold text-slate-900">Income statement</h1>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">Record completed payments and review income from downpayments and full payments.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.income.pdf') }}" class="admin-btn admin-btn-secondary">Download PDF</a>
            <a href="{{ route('admin.dashboard') }}" class="admin-btn admin-btn-outline">Dashboard</a>
            <a href="{{ route('admin.logout') }}" class="admin-btn admin-btn-outline">Logout</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mt-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            Please check the transaction details and try again.
        </div>
    @endif

    <div class="mt-6 grid gap-4 md:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-[#008CBA]">Total Income</p>
            <p class="mt-3 text-3xl font-semibold text-slate-900">PHP {{ number_format($totalIncome, 2) }}</p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-[#008CBA]">Downpayments</p>
            <p class="mt-3 text-3xl font-semibold text-slate-900">PHP {{ number_format($downpaymentTotal, 2) }}</p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-[#008CBA]">Full Payments</p>
            <p class="mt-3 text-3xl font-semibold text-slate-900">PHP {{ number_format($fullPaymentTotal, 2) }}</p>
        </div>
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-[0.85fr_1.25fr]">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Add income transaction</h2>
            <form method="POST" action="{{ route('admin.income.store') }}" class="mt-6 space-y-4">
                @csrf

                <div>
                    <label for="client_name" class="mb-2 block text-sm font-semibold text-slate-700">Client name</label>
                    <input id="client_name" name="client_name" type="text" value="{{ old('client_name') }}" required class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-[#3B0066] focus:outline-none">
                </div>

                <div>
                    <label for="service_name" class="mb-2 block text-sm font-semibold text-slate-700">Service</label>
                    <select id="service_name" name="service_name" required class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-[#3B0066] focus:outline-none">
                        <option value="" disabled {{ old('service_name') ? '' : 'selected' }}>Select a service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->title }}" {{ old('service_name') === $service->title ? 'selected' : '' }}>{{ $service->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="payment_type" class="mb-2 block text-sm font-semibold text-slate-700">Payment type</label>
                    <select id="payment_type" name="payment_type" required class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-[#3B0066] focus:outline-none">
                        <option value="downpayment" {{ old('payment_type') === 'downpayment' ? 'selected' : '' }}>Downpayment</option>
                        <option value="full_payment" {{ old('payment_type') === 'full_payment' ? 'selected' : '' }}>Full payment</option>
                    </select>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label for="amount" class="mb-2 block text-sm font-semibold text-slate-700">Amount</label>
                        <input id="amount" name="amount" type="number" min="0.01" step="0.01" value="{{ old('amount') }}" required class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-[#3B0066] focus:outline-none">
                    </div>
                    <div>
                        <label for="paid_at" class="mb-2 block text-sm font-semibold text-slate-700">Date paid</label>
                        <input id="paid_at" name="paid_at" type="date" value="{{ old('paid_at', now()->toDateString()) }}" required class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-[#3B0066] focus:outline-none">
                    </div>
                </div>

                <div>
                    <label for="notes" class="mb-2 block text-sm font-semibold text-slate-700">Notes</label>
                    <textarea id="notes" name="notes" rows="4" class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-[#3B0066] focus:outline-none">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="rounded-lg bg-[#3B0066] px-4 py-2 text-sm font-semibold text-white">Save transaction</button>
            </form>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-xl font-semibold text-slate-900">Recorded income</h2>
                <p class="text-sm text-slate-500">{{ $transactions->total() }} transactions</p>
            </div>

            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-600">
                            <th class="py-3 pr-4 font-semibold">Date</th>
                            <th class="py-3 pr-4 font-semibold">Client</th>
                            <th class="py-3 pr-4 font-semibold">Service</th>
                            <th class="py-3 pr-4 font-semibold">Type</th>
                            <th class="py-3 pr-4 font-semibold">Amount</th>
                            <th class="py-3 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr class="border-b border-slate-100 align-top">
                                <td class="py-3 pr-4 text-slate-600">{{ $transaction->paid_at->format('M d, Y') }}</td>
                                <td class="py-3 pr-4 font-medium text-slate-800">{{ $transaction->client_name }}</td>
                                <td class="py-3 pr-4 text-slate-600">{{ $transaction->service_name }}</td>
                                <td class="py-3 pr-4 text-slate-600">{{ $transaction->payment_type === 'downpayment' ? 'Downpayment' : 'Full payment' }}</td>
                                <td class="py-3 pr-4 font-semibold text-slate-900">PHP {{ number_format($transaction->amount, 2) }}</td>
                                <td class="py-3">
                                    <form method="POST" action="{{ route('admin.income.destroy', $transaction) }}" onsubmit="return confirm('Remove this income transaction?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg border border-rose-300 px-3 py-2 text-sm font-semibold text-rose-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-slate-500">No income transactions recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
