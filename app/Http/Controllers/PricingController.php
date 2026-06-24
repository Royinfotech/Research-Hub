<?php

namespace App\Http\Controllers;

use App\Models\Service;

class PricingController extends Controller
{
    public function index()
    {
        $researchServices = Service::query()->where('category', 'research')->get();
        $websiteServices = Service::query()->where('category', 'website')->get();

        return view('pricing', compact('researchServices', 'websiteServices'));
    }
}
