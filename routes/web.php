<?php

use App\Http\Controllers\Admin\createAccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MemberDashboardController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\WalkinSessionController;
use App\Http\Controllers\Admin\SessionsController;
use App\Http\Controllers\Admin\QrScanController;
use App\Http\Controllers\Admin\ResetPasswordController;
use Phiki\Phast\Root;

Route::get('/', function () {
    return view('landingPage');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'attempt'])->name('attempt');


Route::get('/forgot-password', [ResetPasswordController::class, 'showReset'])->name('password.request');
Route::post('/forgot-password', [ResetPasswordController::class , 'submit'])->name('password.email');
Route::post('/reset-password', [ResetPasswordController::class,'update'])->name('password.update');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetForm'])->name('password.reset');



Route::middleware('auth')->group(function (){
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/dashboard', [LoginController::class, 'Logout'])->name('logout');

        Route::prefix('members')->name('members.')->group(function () {
            Route::get('/members', [MembersController::class, 'index'])->name('index');
            Route::post('/', [MembersController::class, 'store'])->name('store');
            Route::get('/createMembers', [MembersController::class, 'create'])->name('create');
            Route::delete('/{userMemberships}', [MembersController::class, 'destroy'])->name('destroy');
            Route::put('/{userMemberships}', [MembersController::class, 'update'])->name('update');
        });


        Route::prefix('membership')->name('membership.')->group(function () {
            Route::get('/membershipPlan', [MembershipController::class, 'index'])->name('index');
            Route::get('/createMembership', [MembershipController::class, 'create'])->name('create');
            Route::post('/membershipPlan', [MembershipController::class, 'store'])->name('store');
            Route::delete('/{membershipPlan}', [MembershipController::class, 'destroy'])->name('destroy');
            Route::put('/{membershipPlan}', [MembershipController::class, 'update'])->name('update');
        });

        Route::prefix('payments')->name('payments.')->group(function () {
            Route::get('/paymentRecords', [PaymentsController::class, 'index'])->name('index');
        });

        Route::prefix('walkin')->name('walkin.')->group(function () {
            Route::get('/walkinSession', [WalkinSessionController::class, 'index'])->name('index');
            Route::get('/createWalkin', [WalkinSessionController::class, 'create'])->name('create');
            Route::post('/walkinSession', [WalkinSessionController::class, 'store'])->name('store');
            Route::put('/{walkinSession}',[WalkinSessionController::class, 'checkout'])->name('checkout');
        });

        Route::prefix('sessions')->name('sessions.')->group(function () {
            Route::get('/memberSessions', [SessionsController::class, 'index'])->name('index');
        });

        Route::prefix('createAnAccount')->name('createAnAccount.')->group(function () {
            Route::get('/createAnAccount', [createAccountController::class, 'create'])->name('create');
            Route::get('/accounts', [createAccountController::class, 'index'])->name('index');
            Route::post('/accounts', [createAccountController::class, 'store'])->name('store');
        });

        

        Route::prefix('scan')->name('scan.')->group(function () {
            Route::get('/scanner', [QrScanController::class, 'scanner'])->name('scanner');
            Route::get('/{user}', [QrScanController::class, 'handle'])->name('qrScan');
        });
    });

    Route::prefix('member')->name('member.')->group(function (){
        Route::get('/dashboard', [MemberDashboardController::class, 'dashboard'])->name('dashboard');
    });
});
