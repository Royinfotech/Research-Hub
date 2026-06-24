@extends('layouts.app')

@section('content')
<div class="py-10 lg:py-16">
    <div class="max-w-3xl">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#008CBA]">About</p>
        <h1 class="mt-3 text-4xl font-semibold text-slate-900 sm:text-5xl">A trusted partner for academic excellence and digital innovation.</h1>
        <p class="mt-5 text-lg leading-8 text-slate-600">Research Hub brings together research insight, academic writing expertise, and modern website development to help clients move from concept to completion with confidence.</p>
    </div>

    <div class="mt-12 grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm shadow-slate-100">
            <h2 class="text-2xl font-semibold text-slate-900">Mission</h2>
            <p class="mt-4 text-lg leading-8 text-slate-600">To provide reliable, confidential, and professional research and digital solutions that help individuals and organizations achieve their goals.</p>
            <h2 class="mt-8 text-2xl font-semibold text-slate-900">Vision</h2>
            <p class="mt-4 text-lg leading-8 text-slate-600">To become a trusted partner in academic excellence and digital innovation.</p>
        </div>
        <div class="rounded-[32px] border border-slate-200 bg-slate-50 p-8 shadow-sm shadow-slate-100">
            <h2 class="text-2xl font-semibold text-slate-900">Values</h2>
            <ul class="mt-4 space-y-3 text-slate-600">
                <li class="rounded-2xl bg-white px-4 py-3">Professionalism</li>
                <li class="rounded-2xl bg-white px-4 py-3">Integrity</li>
                <li class="rounded-2xl bg-white px-4 py-3">Innovation</li>
                <li class="rounded-2xl bg-white px-4 py-3">Quality</li>
                <li class="rounded-2xl bg-white px-4 py-3">Confidentiality</li>
            </ul>
        </div>
    </div>

    <div class="mt-12 grid gap-8 lg:grid-cols-3">
        <div class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm shadow-slate-100">
            <h3 class="text-xl font-semibold text-slate-900">Company Story</h3>
            <p class="mt-4 text-sm leading-7 text-slate-600">Research Hub began with a simple mission: to deliver premium academic and digital support with a refined, professional process. Today it serves students, scholars, educators, and businesses alike.</p>
        </div>
        <div class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm shadow-slate-100">
            <h3 class="text-xl font-semibold text-slate-900">Why Clients Trust Us</h3>
            <p class="mt-4 text-sm leading-7 text-slate-600">Clients trust us because we combine technical depth, research accuracy, transparent communication, and strong respect for deadlines and data confidentiality.</p>
        </div>
        <div class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm shadow-slate-100">
            <h3 class="text-xl font-semibold text-slate-900">Team Expertise</h3>
            <p class="mt-4 text-sm leading-7 text-slate-600">Our team spans research support, thesis development, statistical interpretation, and modern web development with a focus on elegant product delivery.</p>
        </div>
    </div>
</div>
@endsection
