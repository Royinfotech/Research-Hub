<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Research Hub Admin',
            'email' => 'admin@example.com',
        ]);

        $services = [
            ['title' => 'Thesis Writing Assistance', 'category' => 'research', 'description' => 'Full academic support for thesis development and structure.', 'price' => 'From ₱5,000'],
            ['title' => 'Chapter 1 Development', 'category' => 'research', 'description' => 'Professional chapter framing and academic writing support.', 'price' => 'From ₱2,500'],
            ['title' => 'Chapter 4 Data Analysis', 'category' => 'research', 'description' => 'Clear presentation of findings and analysis.', 'price' => 'From ₱4,000'],
            ['title' => 'Statistical Analysis', 'category' => 'research', 'description' => 'Support for data interpretation and evidence-based reporting.', 'price' => 'From ₱3,500'],
            ['title' => 'Turnitin Similarity Checking', 'category' => 'research', 'description' => 'Review of originality and similarity indicators.', 'price' => 'From ₱1,200'],
            ['title' => 'Landing Page Website', 'category' => 'website', 'description' => 'Modern conversion-focused landing pages for services and launches.', 'price' => 'From ₱18,000'],
            ['title' => 'Business Website', 'category' => 'website', 'description' => 'Professional corporate websites with refined layout and content.', 'price' => 'From ₱35,000'],
            ['title' => 'E-Commerce Website', 'category' => 'website', 'description' => 'Feature-rich storefronts for digital selling and growth.', 'price' => 'From ₱60,000'],
            ['title' => 'Website Maintenance', 'category' => 'website', 'description' => 'Reliable upkeep for modern websites and feature updates.', 'price' => 'From ₱3,000/mo'],
            ['title' => 'SEO Setup', 'category' => 'website', 'description' => 'Optimization of structure, metadata, and visibility.', 'price' => 'From ₱6,000'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        Testimonial::create([
            'client_name' => 'Mina A.',
            'message' => 'The team delivered a polished thesis draft and a smooth website experience for our academic project.',
            'rating' => 5,
        ]);

        Testimonial::create([
            'client_name' => 'Luis R.',
            'message' => 'Professional, fast, and highly attentive to detail. The process felt effortless from start to finish.',
            'rating' => 5,
        ]);

        Portfolio::create([
            'title' => 'Academic Research Portal',
            'description' => 'A polished showcase platform for scholarly content and services.',
            'image' => 'portfolio-1.jpg',
            'category' => 'Research',
        ]);

        Portfolio::create([
            'title' => 'Service Launch Website',
            'description' => 'A premium landing page designed for lead generation and conversion.',
            'image' => 'portfolio-2.jpg',
            'category' => 'Website',
        ]);
    }
}
