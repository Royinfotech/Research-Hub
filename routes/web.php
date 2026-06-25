<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:10,1')->name('contact.store');

Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/services', [AdminController::class, 'servicesIndex'])->name('admin.services');
Route::get('/admin/services/export', [AdminController::class, 'exportServices'])->name('admin.services.export');
Route::post('/admin/services', [AdminController::class, 'storeService'])->name('admin.services.store');
Route::get('/admin/services/{service}/edit', [AdminController::class, 'editService'])->name('admin.services.edit');
Route::put('/admin/services/{service}', [AdminController::class, 'updateService'])->name('admin.services.update');
Route::delete('/admin/services/{service}', [AdminController::class, 'destroyService'])->name('admin.services.destroy');
Route::get('/admin/income', [AdminController::class, 'incomeStatement'])->name('admin.income');
Route::post('/admin/income', [AdminController::class, 'storeIncomeTransaction'])->name('admin.income.store');
Route::delete('/admin/income/{incomeTransaction}', [AdminController::class, 'destroyIncomeTransaction'])->name('admin.income.destroy');
Route::get('/admin/income/report.pdf', [AdminController::class, 'downloadIncomeStatement'])->name('admin.income.pdf');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/test-email', function () {
    try {
        \Mail::raw('This is a test email from Research Hub', function ($message) {
            $message->to('alimaongroyvan@gmail.com')
                    ->subject('Test Email');
        });
        return 'Email sent successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});