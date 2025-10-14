<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipPlan;


class MembershipController extends Controller
{
    public function index()
    {
        $membershipPlans = MembershipPlan::orderBy('price', 'asc')->get();
        return view('admin.membership.membershipPlan', ['membershipPlans' => $membershipPlans]);
    }

    public function show($id)
    {
        $membershipPlans = MembershipPlan::findOrFail($id);
        return view('admin.membership.showMembership', ['membershipPlans' => $membershipPlans]);
    }
    public function create()
    {
        return view('admin.membership.createMembership');
    }
}
