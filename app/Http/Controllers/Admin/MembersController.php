<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserMemberships;
use App\Http\Controllers\Controller;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userMemberships = UserMemberships::with(['user', 'membershipPlan'])->orderBy('is_active', 'desc')->paginate(10);
        return view('admin.members.members', ['userMemberships' => $userMemberships]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userMemberships = UserMemberships::all();
        $membershipPlans = MembershipPlan::all();
        return view('admin.members.createMembers', ['userMemberships' => $userMemberships, 'membershipPlans' => $membershipPlans]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
