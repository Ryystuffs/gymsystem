<?php

namespace App\Http\Controllers;

use App\Models\createMembers;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;

class CreateMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $membershipPlans = MembershipPlan::all();
        return view('admin.members.createMembers', compact('membershipPlans'));
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
    public function show(createMembers $createMembers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(createMembers $createMembers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, createMembers $createMembers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(createMembers $createMembers)
    {
        //
    }
}
