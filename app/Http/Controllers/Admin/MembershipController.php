<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $membershipPlans = MembershipPlan::all();
        return view('admin.membership.membershipPlan', ['membershipPlans' => $membershipPlans]);
    }

    public function create()
    {
        return view('admin.membership.createMembership');
    }
}
