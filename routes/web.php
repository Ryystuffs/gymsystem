<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\WalkinSessionController;
use App\Http\Controllers\Admin\MemberSessionsController;

Route::get('/', function () {
    return view('login');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('members')->name('members.')->group(function () {
        Route::get('/members', [MembersController::class, 'index'])->name('index');
        Route::post('/', [MembersController::class, 'store'])->name('store');
        Route::get('/createMembers', [MembersController::class, 'create'])->name('createMembers');
    });
    

    Route::prefix('membership')->name('membership.')->group(function () {
        Route::get('/membershipPlan', [MembershipController::class, 'index'])->name('membershipPlan');
        Route::get('/createMembership', [MembershipController::class, 'create'])->name('createMembership');
        Route::get('/showMembership/{id}', [MembershipController::class, 'show'])->name('showMembership');
    });

    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/paymentRecords', [PaymentsController::class, 'index'])->name('paymentRecords');
    });

    Route::prefix('walkin')->name('walkin.')->group(function (){
        Route::get('/walkinSession', [WalkinSessionController::class, 'index'])->name('index');
    });

    Route::prefix('sessions')->name('sessions.')->group(function(){
        Route::get('/memberSessions', [MemberSessionsController::class, 'index'])->name('index');
    });
});

