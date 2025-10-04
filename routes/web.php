<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');



Route::get('/admin/membershipPlan', function (){
    return view ('admin.membershipPlan');
})->name('admin.membershipPlan');

Route::get('/admin/createMembership', function (){
    return view ('admin.createMembership');
})->name('admin.createMembership');
