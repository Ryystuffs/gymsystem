<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserMemberships;
use App\Http\Controllers\Controller;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;
use App\Models\Payments;
use App\Services\MembershipService;
use App\Http\Requests\StoreUserMembershipRequest;
use App\Http\Requests\UpdateUserMembershipRequest;

class MembersController extends Controller
{

    protected $membershipService;

    public function __construct(MembershipService $membershipService)
    {
        $this->membershipService = $membershipService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userMemberships = UserMemberships::with(['user', 'membershipPlan'])->orderBy('created_at', 'desc')->paginate(10);
        $membershipPlans = MembershipPlan::all();
        $payments = Payments::with('user')->get();
        return view('admin.members.members', ['userMemberships' => $userMemberships, 'membershipPlans' => $membershipPlans , 'payments' => $payments]);
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
    public function store(StoreUserMembershipRequest $request)
    {
        $this->membershipService->createUserMemberships($request->validated());
        return redirect()->route('admin.members.index')->with('success','New member has been created successfully.');
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
    public function update(UpdateUserMembershipRequest $request, UserMemberships $userMemberships)
    {
        //
        $this->membershipService->updateUserMemberships($userMemberships, $request->validated());
        return redirect()->route('admin.members.index')->with('success', 'Member membership has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserMemberships $userMemberships)
    {
        $userName = $userMemberships->user->name; // get user name before deleting
        $this->membershipService->deleteUserMembership($userMemberships);

        return redirect()
            ->route('admin.members.index')
            ->with('deleted', "$userName membership successfully deleted!");
    }
    

}
