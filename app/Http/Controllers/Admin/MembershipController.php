<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipPlan;
use App\Services\PlanService;

class MembershipController extends Controller
{

    protected $membershipPlan;

    public function __construct( PlanService $membershipPlanService)
    {   
        $this->membershipPlan = $membershipPlanService;
    }
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

    public function destroy(MembershipPlan $membershipPlan){
        $this->membershipPlan->deleteMembershipPlan($membershipPlan);

        return redirect()->route('admin.membership.index')->with('success', 'MembershipPlan Deleted');
    }
}

?>
