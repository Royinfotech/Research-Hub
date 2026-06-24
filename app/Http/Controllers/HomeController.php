<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::query()->latest()->take(6)->get();
        $testimonials = Testimonial::query()->latest()->take(3)->get();

        return view('home', compact('services', 'testimonials'));
    }
}
