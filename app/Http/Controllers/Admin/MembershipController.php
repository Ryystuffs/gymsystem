<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $membershipPlans = MembershipPlan::orderBy('price', 'asc')->get();
        return view('admin.membership.membershipPlan', ['membershipPlans' => $membershipPlans]);
    }

    public function show($MembershipPlanID)
    {
        $membershipPlan = MembershipPlan::findOrFail($MembershipPlanID);
        return view('admin.membership.showMembership', ['membershipPlan' => $membershipPlan]);
    }
    public function create()
    {
        return view('admin.membership.createMembership');
    }
}
