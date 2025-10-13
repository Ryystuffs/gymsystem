<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserMemberships;
use App\Http\Controllers\Controller;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;
use App\Models\Payments;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userMemberships = UserMemberships::with(['user', 'membershipPlan'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.members.members', ['userMemberships' => $userMemberships]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userMemberships = UserMemberships::with('user')->get();
        $membershipPlans = MembershipPlan::all();
        return view('admin.members.createMembers', ['userMemberships' => $userMemberships, 'membershipPlans' => $membershipPlans]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'expired_at' => 'required|date',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);
        Payments::create([
        'user_id' => $validated['user_id'],
        'membership_plans_id' => $validated['membership_plan_id'],
        'amount' => $validated['amount'],
        'payment_method' => $validated['payment_method'],
        'type' => 'Membership',
        'created_at' => now(),
        ]);
        UserMemberships::create([
        'user_id' => $validated['user_id'],
        'membership_plan_id' => $validated['membership_plan_id'],
        'expired_at' => $validated['expired_at'],
        'is_active' => true,
        'created_at' => now(),
    ]);

        return redirect()->route('admin.members.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
