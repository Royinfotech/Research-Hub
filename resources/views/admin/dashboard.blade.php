@extends('layouts.app')

@section('content')
<div class="py-8 lg:py-10">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#008CBA]">Admin Dashboard</p>
                <h1 class="mt-2 text-3xl font-semibold text-slate-900">Manage inquiries and services</h1>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.services') }}" class="admin-btn">Manage services</a>
                <a href="{{ route('admin.income') }}" class="admin-btn admin-btn-secondary">Income statement</a>
                <a href="{{ route('admin.logout') }}" class="admin-btn admin-btn-outline">Logout</a>
            </div>
        </div>

        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-[#008CBA]">Total Income</p>
                <p class="mt-3 text-3xl font-semibold text-slate-900">PHP {{ number_format($incomeTotal, 2) }}</p>
            </div>
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-[#008CBA]">Downpayments</p>
                <p class="mt-3 text-3xl font-semibold text-slate-900">PHP {{ number_format($downpaymentTotal, 2) }}</p>
            </div>
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-[#008CBA]">Full Payments</p>
                <p class="mt-3 text-3xl font-semibold text-slate-900">PHP {{ number_format($fullPaymentTotal, 2) }}</p>
            </div>
        </div>
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Recent Inquiries</h2>
            <div class="mt-5 space-y-3">
                @forelse($contacts as $contact)
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="font-semibold text-slate-900">{{ $contact->name }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $contact->email }}</p>
                        <p class="mt-1 text-sm text-slate-600">{{ $contact->service }}</p>
                    </div>
                @empty
                    <p class="rounded-xl border border-dashed border-slate-200 px-4 py-6 text-center text-sm text-slate-500">No inquiries yet.</p>
                @endforelse
            </div>
            <div class="mt-5">
                {{ $contacts->links() }}
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Service Catalog</h2>
            <div class="mt-5 space-y-3">
                @forelse($services as $service)
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="font-semibold text-slate-900">{{ $service->title }}</p>
                        <p class="mt-1 text-sm text-slate-600">{{ ucfirst($service->category) }} - {{ $service->price ?: 'Custom quote' }}</p>
                    </div>
                @empty
                    <p class="rounded-xl border border-dashed border-slate-200 px-4 py-6 text-center text-sm text-slate-500">No services yet.</p>
                @endforelse
            </div>
            <div class="mt-5">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
