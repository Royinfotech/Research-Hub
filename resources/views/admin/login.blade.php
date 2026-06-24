@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-md py-16">
    <div class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm shadow-slate-100">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#008CBA]">Admin</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">Secure access</h1>
        <form action="{{ route('admin.login.post') }}" method="POST" class="mt-8 space-y-5">
            @csrf
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700" for="password">Password</label>
                <input id="password" name="password" type="password" required class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-[#008CBA]">
            </div>
            <button type="submit" class="w-full rounded-full bg-gradient-to-r from-[#3B0066] to-[#008CBA] px-6 py-3 font-semibold text-white">Login</button>
        </form>
    </div>
</div>
@endsection
