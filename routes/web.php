<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');



Route::get('/admin/membership/membershipPlan', function (){
    return view ('admin.membership.membershipPlan');
})->name('admin.membership.membershipPlan');

Route::get('/admin/membership/createMembership', function (){
    return view ('admin.membership.createMembership');
})->name('admin.membership.createMembership');
