<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //  
    public function index(){
        return view ('login');
    }

    public function attempt(Request $request){


        $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
        ]);

        if(Auth::attempt($validated)){
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin'){
                return redirect()->route('admin.dashboard');
            }
            if ($user->role === 'member'){
                return redirect()->route('member.dashboard');
            }
        }

        return back()->with('error', 'Sorry, wrong credentials.');
    }


    public function logOut(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');    
    }
}
