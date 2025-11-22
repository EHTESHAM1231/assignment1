<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillOfferController;

Route::get('/', function () {
    return redirect()->route('skill-offers.index');
});

Route::resource('skill-offers', SkillOfferController::class);
