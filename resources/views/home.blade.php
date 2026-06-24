@extends('layouts.app')

@section('content')
<div class="grid items-center gap-12 py-10 lg:grid-cols-[1.1fr_0.9fr] lg:py-16">
    <div>
        <p class="mb-4 inline-flex rounded-full border border-[#3B0066]/20 bg-[#3B0066]/5 px-4 py-2 text-sm font-medium text-[#3B0066]">Premium Research & Digital Services</p>
        <h1 class="max-w-3xl text-4xl font-semibold leading-tight text-slate-900 sm:text-5xl lg:text-6xl">Transforming Ideas into Research Excellence and Digital Solutions</h1>
        <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-600">Professional research assistance, thesis support, statistical analysis, and website development solutions designed for students, researchers, educators, and businesses.</p>
        <div class="mt-8 flex flex-wrap gap-4">
            <a href="{{ route('contact') }}" class="rounded-full bg-gradient-to-r from-[#3B0066] to-[#008CBA] px-6 py-3 font-semibold text-white shadow-lg shadow-slate-200 transition hover:-translate-y-1">Get Started</a>
            <a href="{{ route('services') }}" class="rounded-full border border-slate-300 px-6 py-3 font-semibold text-slate-700 transition hover:border-[#3B0066] hover:text-[#3B0066]">View Services</a>
        </div>
        <div class="mt-8 flex flex-wrap gap-4 text-sm text-slate-500">
            <span class="rounded-full border border-slate-200 bg-white px-3 py-2">Confidentiality First</span>
            <span class="rounded-full border border-slate-200 bg-white px-3 py-2">On-Time Delivery</span>
            <span class="rounded-full border border-slate-200 bg-white px-3 py-2">Trusted by Students & Teams</span>
        </div>
    </div>
    <div class="rounded-[32px] border border-slate-200 bg-gradient-to-br from-[#3B0066] via-[#4a217a] to-[#008CBA] p-8 text-white shadow-2xl shadow-purple-100">
        <div class="rounded-3xl border border-white/20 bg-white/10 p-6 backdrop-blur">
            <div class="mb-5 flex items-center justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-white/70">Research Hub</p>
                    <p class="mt-2 text-2xl font-semibold">Project Dashboard</p>
                </div>
                <div class="rounded-full border border-white/30 bg-white/20 px-3 py-1 text-sm">Live</div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl bg-white/15 p-4">
                    <p class="text-sm text-white/70">Research Support</p>
                    <p class="mt-2 text-3xl font-semibold">24/7</p>
                </div>
                <div class="rounded-2xl bg-white/15 p-4">
                    <p class="text-sm text-white/70">Website Delivery</p>
                    <p class="mt-2 text-3xl font-semibold">Fast</p>
                </div>
            </div>
            <div class="mt-5 rounded-2xl bg-slate-950/25 p-5">
                <p class="text-sm text-white/70">Focus Areas</p>
                <div class="mt-3 flex flex-wrap gap-2">
                    <span class="rounded-full bg-white/20 px-3 py-1 text-sm">Thesis</span>
                    <span class="rounded-full bg-white/20 px-3 py-1 text-sm">SPSS</span>
                    <span class="rounded-full bg-white/20 px-3 py-1 text-sm">Web Design</span>
                    <span class="rounded-full bg-white/20 px-3 py-1 text-sm">SEO</span>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="py-10">
    <div class="mb-8 flex items-end justify-between gap-4">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#008CBA]">Why Choose Research Hub</p>
            <h2 class="mt-2 text-3xl font-semibold text-slate-900">Professional support crafted for academic and digital growth.</h2>
        </div>
    </div>
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-5">
        @php($benefits = [
            ['title' => 'Quality Work', 'text' => 'Delivering accurate, reliable, and professionally prepared outputs.'],
            ['title' => 'On-Time Delivery', 'text' => 'Committed to meeting deadlines with efficient workflow.'],
            ['title' => 'Affordable Rates', 'text' => 'Professional services at competitive prices.'],
            ['title' => 'Professional Support', 'text' => 'Guidance and assistance throughout the process.'],
            ['title' => '100% Confidentiality', 'text' => 'Protecting client information and research materials.'],
        ])
        @foreach($benefits as $item)
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100 transition hover:-translate-y-1 hover:shadow-xl">
                <div class="mb-4 h-11 w-11 rounded-2xl bg-gradient-to-br from-[#3B0066] to-[#008CBA]"></div>
                <h3 class="text-lg font-semibold text-slate-900">{{ $item['title'] }}</h3>
                <p class="mt-3 text-sm leading-7 text-slate-600">{{ $item['text'] }}</p>
            </div>
        @endforeach
    </div>
</section>

<section class="grid gap-8 py-12 lg:grid-cols-[0.95fr_1.05fr]">
    <div class="rounded-[32px] border border-slate-200 bg-slate-50 p-8">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#008CBA]">About Research Hub</p>
        <h2 class="mt-3 text-3xl font-semibold text-slate-900">Research Hub provides professional academic and digital solutions.</h2>
        <p class="mt-5 text-lg leading-8 text-slate-600">We assist students, researchers, educators, and businesses through research consulting, thesis support, statistical services, and modern website development. Our goal is to transform ideas into meaningful results through quality, innovation, and professionalism.</p>
        <a href="{{ route('about') }}" class="mt-6 inline-flex rounded-full border border-[#3B0066]/20 px-5 py-2.5 font-semibold text-[#3B0066] transition hover:bg-[#3B0066] hover:text-white">Learn More About Us</a>
    </div>
    <div class="grid gap-4">
        @foreach($services->take(3) as $service)
            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-100">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#008CBA]">{{ ucfirst($service->category) }}</p>
                        <h3 class="mt-2 text-xl font-semibold text-slate-900">{{ $service->title }}</h3>
                    </div>
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">{{ $service->price }}</span>
                </div>
                <p class="mt-3 text-sm leading-7 text-slate-600">{{ $service->description }}</p>
            </div>
        @endforeach
    </div>
</section>

<section class="py-12">
    <div class="mb-8 flex items-end justify-between gap-4">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#008CBA]">Team</p>
            <h2 class="mt-2 text-3xl font-semibold text-slate-900">A discreet, professional team focused on quality.</h2>
        </div>
    </div>
    <div class="grid gap-6 lg:grid-cols-3">
        @php($team = [
            ['name' => 'Research Specialist', 'role' => 'Research Specialist', 'bio' => 'Licensed Professional Teacher with an active master’s journey in Education and expertise in academic research and methodology.', 'skills' => ['Research Methodology','Educational Studies','Academic Writing']],
            ['name' => 'Research Specialist', 'role' => 'Research Specialist', 'bio' => 'Experienced in thesis assistance, academic writing, and research consultation for scholarly projects.', 'skills' => ['Thesis Support','Editing','Consultation']],
            ['name' => 'Web Development Specialist', 'role' => 'Web Development Specialist', 'bio' => 'Cum Laude IT graduate specializing in web development, databases, UI/UX, and software solutions.', 'skills' => ['UI/UX','Databases','Web Development']],
        ])
        @foreach($team as $member)
            <div class="rounded-[28px] border border-slate-200 bg-white p-7 shadow-sm shadow-slate-100">
                <div class="mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-[#3B0066] to-[#008CBA] text-xl font-semibold text-white">{{ strtoupper(substr($member['name'],0,1)) }}</div>
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-[#008CBA]">{{ $member['role'] }}</p>
                <h3 class="mt-2 text-xl font-semibold text-slate-900">{{ $member['name'] }}</h3>
                <p class="mt-4 text-sm leading-7 text-slate-600">{{ $member['bio'] }}</p>
                <div class="mt-5 flex flex-wrap gap-2">
                    @foreach($member['skills'] as $skill)
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-700">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="py-12">
    <div class="rounded-[32px] border border-slate-200 bg-gradient-to-r from-[#3B0066] to-[#008CBA] p-8 text-white shadow-xl shadow-purple-100">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-white/70">Client Confidence</p>
                <h2 class="mt-2 text-3xl font-semibold">Trusted by students, researchers, and growing businesses.</h2>
            </div>
            <a href="{{ route('contact') }}" class="rounded-full bg-white px-6 py-3 font-semibold text-[#3B0066] transition hover:bg-slate-100">Start Your Project</a>
        </div>
    </div>
</section>
@endsection
