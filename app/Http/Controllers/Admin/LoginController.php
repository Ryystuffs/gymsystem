<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    //  
    public function index(){
        
        $admins = User::where('role', 'admin')->count();
        
        if ($admins == 0) {
            return redirect()->route('register.index');
        }
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
