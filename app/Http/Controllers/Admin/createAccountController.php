<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class createAccountController extends Controller
{
    public function create(){
        return view('admin.createAnAccount.createAnAccount');
    }
}
