@extends('layouts.app')

@section('content')
<div class="py-8 lg:py-10">
    <div class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:flex-row lg:items-center lg:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#008CBA]">Admin Panel</p>
            <h1 class="mt-2 text-3xl font-semibold text-slate-900">Manage service catalog</h1>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">Services added here appear on the public Services and Pricing pages.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.services.export') }}" class="admin-btn admin-btn-secondary">Export services</a>
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
            Please check the service details and try again.
        </div>
    @endif

    <div class="mt-6 grid gap-6 xl:grid-cols-[0.9fr_1.2fr]">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">{{ $editingService ? 'Edit service' : 'Add a new service' }}</h2>
            <form method="POST" action="{{ $editingService ? route('admin.services.update', $editingService) : route('admin.services.store') }}" class="mt-6 space-y-4">
                @csrf
                @if($editingService)
                    @method('PUT')
                @endif

                <div>
                    <label for="title" class="mb-2 block text-sm font-semibold text-slate-700">Service title</label>
                    <input id="title" name="title" type="text" value="{{ old('title', $editingService->title ?? '') }}" required class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-[#3B0066] focus:outline-none">
                </div>

                <div>
                    <label for="category" class="mb-2 block text-sm font-semibold text-slate-700">Category</label>
                    <select id="category" name="category" required class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-[#3B0066] focus:outline-none">
                        <option value="research" {{ old('category', $editingService->category ?? '') === 'research' ? 'selected' : '' }}>Research / Thesis Services</option>
                        <option value="website" {{ old('category', $editingService->category ?? '') === 'website' ? 'selected' : '' }}>Website Services</option>
                    </select>
                </div>

                <div>
                    <label for="price" class="mb-2 block text-sm font-semibold text-slate-700">Price / rate</label>
                    <input id="price" name="price" type="text" value="{{ old('price', $editingService->price ?? '') }}" placeholder="e.g. PHP 2,500" class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-[#3B0066] focus:outline-none">
                </div>

                <div>
                    <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">Description</label>
                    <textarea id="description" name="description" rows="5" required class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-[#3B0066] focus:outline-none">{{ old('description', $editingService->description ?? '') }}</textarea>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="rounded-lg bg-[#3B0066] px-4 py-2 text-sm font-semibold text-white">{{ $editingService ? 'Update service' : 'Save service' }}</button>
                    @if($editingService)
                        <a href="{{ route('admin.services') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700">Cancel</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-xl font-semibold text-slate-900">Current services</h2>
                <p class="text-sm text-slate-500">{{ $services->total() }} services</p>
            </div>

            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-600">
                            <th class="py-3 pr-4 font-semibold">Service</th>
                            <th class="py-3 pr-4 font-semibold">Category</th>
                            <th class="py-3 pr-4 font-semibold">Price</th>
                            <th class="py-3 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr class="border-b border-slate-100 align-top">
                                <td class="py-3 pr-4">
                                    <p class="font-semibold text-slate-900">{{ $service->title }}</p>
                                    <p class="mt-1 max-w-md text-sm leading-6 text-slate-600">{{ \Illuminate\Support\Str::limit($service->description, 110) }}</p>
                                </td>
                                <td class="py-3 pr-4 text-slate-600">{{ ucfirst($service->category) }}</td>
                                <td class="py-3 pr-4 font-medium text-[#3B0066]">{{ $service->price ?: 'Custom quote' }}</td>
                                <td class="py-3">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-semibold text-slate-700">Edit</a>
                                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Remove this service from the public catalog?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg border border-rose-300 px-3 py-2 text-sm font-semibold text-rose-600">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-slate-500">No services added yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
