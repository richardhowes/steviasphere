<?php

use App\Http\Controllers\OrganisationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\WorkOS\Http\Middleware\ValidateSessionWithWorkOS;

Route::get('/', fn () => Inertia::render('Welcome'));

Route::middleware([
    'auth',
    ValidateSessionWithWorkOS::class,
])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Organisation routes
    Route::resource('organisations', OrganisationController::class);

    // Farming routes
    Route::get('farming', function () {
        return Inertia::render('Farming/Index');
    })->name('farming.index');

    // Laboratory routes
    Route::get('laboratory', function () {
        return Inertia::render('Laboratory/Index');
    })->name('laboratory.index');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
