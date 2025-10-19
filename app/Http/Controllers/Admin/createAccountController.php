<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class createAccountController extends Controller
{

    public function index(){
        $users = User::paginate(10);
        return view('admin.createAnAccount.accounts', [ 'users' => $users ]);
    }
    public function create(){
        return view('admin.createAnAccount.createAnAccount');
    }
}
