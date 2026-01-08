<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillOfferController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('skill-offers.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// OAuth Routes (Socialite)
Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])
    ->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])
    ->name('socialite.callback');

// Public routes - anyone can view skill offers
Route::get('/skill-offers', [SkillOfferController::class, 'index'])->name('skill-offers.index');

// Protected routes - require authentication (create must come before show)
Route::middleware('auth')->group(function () {
    Route::get('/skill-offers/create', [SkillOfferController::class, 'create'])->name('skill-offers.create');
    Route::post('/skill-offers', [SkillOfferController::class, 'store'])->name('skill-offers.store');
    Route::get('/skill-offers/{skillOffer}/edit', [SkillOfferController::class, 'edit'])->name('skill-offers.edit');
    Route::patch('/skill-offers/{skillOffer}', [SkillOfferController::class, 'update'])->name('skill-offers.update');
    Route::delete('/skill-offers/{skillOffer}', [SkillOfferController::class, 'destroy'])->name('skill-offers.destroy');
});

// Public show route (after create to avoid route conflict)
Route::get('/skill-offers/{skillOffer}', [SkillOfferController::class, 'show'])->name('skill-offers.show');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';