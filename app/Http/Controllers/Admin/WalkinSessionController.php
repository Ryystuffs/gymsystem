<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WalkinSession;
use Illuminate\Http\Request;

class WalkinSessionController extends Controller
{
    //
    public function index(){


        $walkinSession = WalkinSession::orderBy('check_in', 'desc')->paginate(10);
        return view('admin.walkin.walkinSession', ['walkinSessions' => $walkinSession]);
    }

    public function create(){


        return view('admin.walkin.createWalkin');
    }
}
