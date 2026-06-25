<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Research Hub provides premium research, thesis, statistical analysis, and website development services with professional support and confidentiality.">
    <meta name="theme-color" content="#3B0066">

    <meta property="og:title" content="Research Hub | Research Excellence & Digital Solutions">
    <meta property="og:description" content="Professional research assistance, thesis support, statistical analysis, and website development solutions for students, researchers, educators, and businesses.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">

    <title>{{ $pageTitle ?? 'Research Hub' }}</title>


    @vite(['resources/css/app.css','resources/js/app.js'])

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-white text-slate-800 antialiased">
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,_rgba(59,0,102,0.12),_transparent_35%),radial-gradient(circle_at_90%_10%,_rgba(0,140,186,0.14),_transparent_25%)]"></div>
        <svg class="pointer-events-none absolute left-1/2 top-20 -z-10 h-[760px] w-[1800px] max-w-none -translate-x-1/2 text-slate-400 opacity-35" viewBox="0 0 1800 760" fill="none" aria-hidden="true">
            <g stroke="currentColor" stroke-width="2">
                @for($i = 0; $i < 24; $i++)
                    <path d="M -160 {{ 260 + ($i * 12) }} C 110 {{ 130 + ($i * 5) }}, 300 {{ 650 - ($i * 9) }}, 570 {{ 510 - ($i * 3) }} S 830 {{ 110 + ($i * 8) }}, 1100 {{ 255 + ($i * 6) }} S 1420 {{ 600 - ($i * 4) }}, 1960 {{ 360 + ($i * 5) }}" />
                    <path d="M -180 {{ 360 + ($i * 8) }} C 150 {{ 570 - ($i * 7) }}, 330 {{ 130 + ($i * 11) }}, 650 {{ 590 - ($i * 6) }} S 920 {{ 420 - ($i * 10) }}, 1120 {{ 500 - ($i * 9) }} S 1410 {{ 100 + ($i * 9) }}, 1980 {{ 260 + ($i * 10) }}" />
                @endfor
            </g>
        </svg>
        <div x-data="{ open: false }">
            <header class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('pictures/RHUB_logo.png') }}" alt="Research Hub logo" class="h-12 w-12 rounded-2xl object-cover shadow-lg shadow-purple-200">
                    <div>
                        <p class="text-lg font-semibold text-[#3B0066]">Research Hub</p>
                        <p class="text-sm text-slate-500">Academic + Digital Excellence</p>
                    </div>
                </a>
                <nav class="hidden items-center gap-7 text-sm font-medium text-slate-600 md:flex">
                    <a href="{{ route('home') }}" class="transition hover:text-[#3B0066]">Home</a>
                    <a href="{{ route('services') }}" class="transition hover:text-[#3B0066]">Services</a>
                    <a href="{{ route('pricing') }}" class="transition hover:text-[#3B0066]">Pricing</a>
                    <a href="{{ route('about') }}" class="transition hover:text-[#3B0066]">About</a>
                    <a href="{{ route('contact') }}" class="rounded-full bg-[#3B0066] px-5 py-2.5 text-white transition hover:bg-[#2d004f]">Contact</a>
                </nav>
                <button class="rounded-full border border-slate-200 p-2 text-slate-600 md:hidden" @click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </header>
            <div x-show="open" class="mx-6 rounded-2xl border border-slate-200 bg-white/90 px-5 py-4 shadow-lg md:hidden" x-cloak>
                <div class="flex flex-col gap-3 text-sm font-medium text-slate-600">
                    <a href="{{ route('home') }}" class="transition hover:text-[#3B0066]">Home</a>
                    <a href="{{ route('services') }}" class="transition hover:text-[#3B0066]">Services</a>
                    <a href="{{ route('pricing') }}" class="transition hover:text-[#3B0066]">Pricing</a>
                    <a href="{{ route('about') }}" class="transition hover:text-[#3B0066]">About</a>
                    <a href="{{ route('contact') }}" class="font-semibold text-[#3B0066]">Contact</a>
                </div>
            </div>
        </div>

        <main class="mx-auto max-w-7xl px-6 pb-20 lg:px-8">
            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </main>

        <footer class="border-t border-slate-200 bg-slate-50/70">
            <div class="mx-auto flex max-w-7xl flex-col gap-6 px-6 py-10 text-sm text-slate-600 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                <div>
                    <p class="text-base font-semibold text-[#3B0066]">Research Hub</p>
                    <p>Premium research, thesis, and website development solutions.</p>
                </div>
                <div class="flex flex-wrap items-center gap-x-6 gap-y-3">
                    <a href="{{ route('services') }}" class="leading-none transition hover:text-[#3B0066]">Services</a>
                    <a href="{{ route('pricing') }}" class="leading-none transition hover:text-[#3B0066]">Pricing</a>
                    <a href="{{ route('contact') }}" class="leading-none transition hover:text-[#3B0066]">Contact</a>
                    <a href="{{ route('admin.login') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-[#3B0066] px-5 font-semibold leading-none text-white no-underline transition hover:bg-[#2d004f]">Admin Login</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
