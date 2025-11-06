<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MemberDashboardController extends Controller
{
    //

    public function account(){
        $user = Auth::user();
        $membership = $user->userMemberships()->latest()->first();
        return view ('member.account', ['user' => $user , 'membership' => $membership]);
    }

    public function showQrCode(){
        $user = Auth::user();
        return view ('member.qrcode', ['user' => $user]);
    }

    public function dashboard(){
        $user = Auth::user();
        $membership = $user->userMemberships()->latest()->first();
        $sessions = $membership->memberSessions()->orderBy('check_in','desc')->paginate(10);

        return view ('member.dashboard', ['sessions' => $sessions, 'user' => $user]);
    }
}
