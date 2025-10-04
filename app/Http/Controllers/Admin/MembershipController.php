<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        
        return view('admin.membership.membershipPlan');
    }

    public function create()
    {
        return view('admin.membership.createMembership');
    }
}
