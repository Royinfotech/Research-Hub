@extends('layouts.app')

@section('content')
<div class="py-10 lg:py-16">
    <div class="max-w-3xl">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#008CBA]">Pricing</p>
        <h1 class="mt-3 text-4xl font-semibold text-slate-900 sm:text-5xl">Transparent pricing for academic and digital projects.</h1>
        <p class="mt-5 text-lg leading-8 text-slate-600">Clear service tiers, fast turnaround, and strategic support tailored to your project scope.</p>
    </div>

    <div class="mt-12 grid gap-8 xl:grid-cols-2">
        <section class="overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-sm shadow-slate-100">
            <div class="bg-gradient-to-r from-[#3B0066] to-[#008CBA] px-8 py-6 text-white">
                <h2 class="text-2xl font-semibold">Research & Thesis Services</h2>
                <p class="mt-2 text-sm text-white/80">Professional rates for thesis support, statistical analysis, and academic review.</p>
            </div>
            <div class="overflow-x-auto p-4">
                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-600">
                            <th class="py-3 pr-4 font-semibold">Service</th>
                            <th class="py-3 pr-4 font-semibold">Normal Rate</th>
                            <th class="py-3 pr-4 font-semibold">Rush Rate</th>
                            <th class="py-3 font-semibold">Delivery Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($researchServices as $service)
                            <tr class="border-b border-slate-100">
                                <td class="py-3 pr-4 font-medium text-slate-800">{{ $service->title }}</td>
                                <td class="py-3 pr-4 text-slate-600">{{ $service->price }}</td>
                                <td class="py-3 pr-4 text-slate-600">{{ $service->price }}</td>
                                <td class="py-3 text-slate-600">3-7 days</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-sm shadow-slate-100">
            <div class="bg-gradient-to-r from-[#3B0066] to-[#008CBA] px-8 py-6 text-white">
                <h2 class="text-2xl font-semibold">Website Services</h2>
                <p class="mt-2 text-sm text-white/80">Flexible web design and development packages for growing brands.</p>
            </div>
            <div class="overflow-x-auto p-4">
                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-600">
                            <th class="py-3 pr-4 font-semibold">Service</th>
                            <th class="py-3 pr-4 font-semibold">Normal Rate</th>
                            <th class="py-3 pr-4 font-semibold">Rush Rate</th>
                            <th class="py-3 font-semibold">Delivery Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($websiteServices as $service)
                            <tr class="border-b border-slate-100">
                                <td class="py-3 pr-4 font-medium text-slate-800">{{ $service->title }}</td>
                                <td class="py-3 pr-4 text-slate-600">{{ $service->price }}</td>
                                <td class="py-3 pr-4 text-slate-600">{{ $service->price }}</td>
                                <td class="py-3 text-slate-600">5-10 days</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
@endsection
