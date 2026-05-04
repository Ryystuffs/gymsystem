<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\LoginController;
    use App\Http\Controllers\Admin\ResetPasswordController;
    use App\Http\Controllers\Admin\RegisterController;

    Route::get('/', function () {
        return view('landingPage');
    });

    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'attempt'])->name('attempt');


    Route::get('/forgot-password', [ResetPasswordController::class, 'showReset'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'submit'])->name('password.email');
    Route::post('/reset-password', [ResetPasswordController::class, 'update'])->name('password.update');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetForm'])->name('password.reset');

    Route::middleware('auth')->group(function () {
        Route::middleware(['auth', 'admin'])->group(function () {
            Route::livewire('/dashboard', 'pages::admin.dashboard')->name('dashboard');
            Route::livewire('/payment-record', 'pages::admin.payment-records')->name('payment-record');
            Route::livewire('/scanner', 'pages::admin.scanner')->name('scanner');

            Route::prefix('member')->name('members.')->group(function () {
                Route::livewire('/create', 'pages::admin.member.create')->name('create');
                Route::livewire('/list', 'pages::admin.member.list')->name('list');
                Route::livewire('/session', 'pages::admin.member.session')->name('session');
            });

            Route::prefix('membership-plan')->name('membership-plans.')->group(function () {
                Route::livewire('/create', 'pages::admin.membership-plan.create')->name('create');
                Route::livewire('/list', 'pages::admin.membership-plan.list')->name('list');
            });

            Route::prefix('users')->name('users.')->group(function () {
                Route::livewire('/create', 'pages::admin.users.create')->name('create');
                Route::livewire('/list', 'pages::admin.users.list')->name('list');
            });

            Route::prefix('walk-in')->name('walkin.')->group(function () {
                Route::livewire('/create', 'pages::admin.walk-in.create')->name('create');
                Route::livewire('/session', 'pages::admin.walk-in.session')->name('session');
            });
        });

        Route::livewire('/account', 'pages::user.account')->name('account');
        Route::livewire('/dashboard', 'pages::user.dashboard')->name('dashboard');
        Route::livewire('/qr-code', 'pages::user.qr-code')->name('qr-code');
    });
