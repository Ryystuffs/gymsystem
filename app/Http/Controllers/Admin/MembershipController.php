<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipPlan;
use App\Services\PlanService;
use App\Http\Requests\StoreMembershipPlanRequest;
use App\Http\Requests\UpdateMembershipPlanRequest;

class MembershipController extends Controller
{

    protected $membershipPlan;

    public function __construct(PlanService $membershipPlanService)
    {   
        $this->membershipPlan = $membershipPlanService; 
    }
    public function index()
    {
        $membershipPlans = MembershipPlan::orderBy('price', 'asc')->get();
        return view('admin.membership.membershipPlan', ['membershipPlans' => $membershipPlans]);
    }

    public function create()
    {   
        return view('admin.membership.createMembership');
    }

    public function store (StoreMembershipPlanRequest $request){
        $data = $request->validated();
        $this->membershipPlan->createMembershipPlan($data);

        return redirect()->route('admin.membership.index')->with('success', 'Membership Plan Created');
    }

    public function destroy(MembershipPlan $membershipPlan){
        $this->membershipPlan->deleteMembershipPlan($membershipPlan);
        return redirect()->route('admin.membership.index')->with('deleted', 'Membership Plan Deleted');
    }

    public function update(MembershipPlan $membershipPlan, UpdateMembershipPlanRequest $request){
        $data = $request->validated();
        $this->membershipPlan->updateMembershipPlan($membershipPlan, $data);
        return redirect()->route('admin.membership.index')->with('success', 'Membership Plan Updated');
    }
}

?>
