<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MemberDashboardController extends Controller
{
    //

    public function dashboard(){

        

        $user = Auth::user();
        $membership = $user->userMemberships()->latest()->first();
        return view ('member.dashboard', ['user' => $user , 'membership' => $membership]);
    }

    public function showAccount(){
        $user = Auth::user();
        return view ('member.memberAccount', ['user' => $user]);
    }
}
