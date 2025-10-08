<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MembershipController;

Route::get('/', function () {
    return view('login');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('membership')->name('membership.')->group(function () {
        Route::get('/membershipPlan', [MembershipController::class, 'index'])->name('membershipPlan');
        Route::get('/createMembership', [MembershipController::class, 'create'])->name('createMembership');
        Route::get('/showMembership/{id}', [MembershipController::class, 'show'])->name('showMembership');
    });
});

