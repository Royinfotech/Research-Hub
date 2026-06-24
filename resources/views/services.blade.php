@extends('layouts.app')

@section('content')
<div class="py-10 lg:py-16">
    <div class="max-w-3xl">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#008CBA]">Services</p>
        <h1 class="mt-3 text-4xl font-semibold text-slate-900 sm:text-5xl">Research and website solutions designed for precision and growth.</h1>
        <p class="mt-5 text-lg leading-8 text-slate-600">From thesis support to polished business websites, each service is tailored to deliver quality, speed, and clarity.</p>
    </div>

    <div class="mt-12 grid gap-8">
        <section class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm shadow-slate-100">
            <div class="mb-8 flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#008CBA]">Research & Thesis Services</p>
                    <h2 class="mt-2 text-3xl font-semibold text-slate-900">Academic support with professional rigor.</h2>
                </div>
            </div>
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach($researchServices as $service)
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-[#3B0066] to-[#008CBA] text-white">✦</div>
                        <h3 class="text-xl font-semibold text-slate-900">{{ $service->title }}</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $service->description }}</p>
                        <div class="mt-5 flex items-center justify-between">
                            <span class="text-sm font-semibold text-[#3B0066]">{{ $service->price }}</span>
                            <a href="{{ route('contact', ['service' => $service->title]) }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#3B0066] hover:text-[#3B0066]">Request</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm shadow-slate-100">
            <div class="mb-8 flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#008CBA]">Website Services</p>
                    <h2 class="mt-2 text-3xl font-semibold text-slate-900">Modern digital experiences for brands, schools, and businesses.</h2>
                </div>
            </div>
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach($websiteServices as $service)
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-[#3B0066] to-[#008CBA] text-white">◉</div>
                        <h3 class="text-xl font-semibold text-slate-900">{{ $service->title }}</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $service->description }}</p>
                        <div class="mt-5 flex items-center justify-between">
                            <span class="text-sm font-semibold text-[#3B0066]">{{ $service->price }}</span>
                            <a href="{{ route('contact', ['service' => $service->title]) }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#3B0066] hover:text-[#3B0066]">Request</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection
