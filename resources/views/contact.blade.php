@extends('layouts.app')

@section('content')
<div class="py-10 lg:py-16">
    <div class="max-w-3xl">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#008CBA]">Contact</p>
        <h1 class="mt-3 text-4xl font-semibold text-slate-900 sm:text-5xl">Let’s discuss your research or website project.</h1>
        <p class="mt-5 text-lg leading-8 text-slate-600">Send us your requirements and we will get back to you with a tailored plan and professional guidance.</p>
    </div>

    <div class="mt-12 grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
        <div class="rounded-[32px] border border-slate-200 bg-slate-50 p-8 shadow-sm shadow-slate-100">
            <h2 class="text-2xl font-semibold text-slate-900">Reach Out</h2>
            <div class="mt-6 space-y-4 text-sm text-slate-600">
                <p><span class="block font-semibold text-slate-900">Email</span> xd77company@gmail.com</p>
                <p><span class="block font-semibold text-slate-900">Social</span> LinkedIn • Facebook • Instagram</p>
                <p><span class="block font-semibold text-slate-900">Response Time</span> Within 24 hours on business days</p>
            </div>
        </div>

        <form action="{{ route('contact.store') }}" method="POST" class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm shadow-slate-100">
            @csrf
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700" for="name">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-[#008CBA]">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-[#008CBA]">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700" for="phone">Phone (optional)</label>
                    <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-[#008CBA]">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700" for="service">Service Interested</label>
                    <input id="service" name="service" type="text" value="{{ old('service', $selectedService ?? '') }}" required class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-[#008CBA]">
                </div>
            </div>
            <div class="mt-5">
                <label class="mb-2 block text-sm font-semibold text-slate-700" for="message">Message</label>
                <textarea id="message" name="message" rows="5" required class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-[#008CBA]">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="mt-6 rounded-full bg-gradient-to-r from-[#3B0066] to-[#008CBA] px-6 py-3 font-semibold text-white shadow-lg shadow-slate-200 transition hover:-translate-y-1">Send Inquiry</button>
        </form>
    </div>
</div>
@endsection
