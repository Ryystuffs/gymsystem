<?php
    namespace App\Services;

    use App\Models\MembershipPlan;
    use Illuminate\Support\Facades\DB;

    class PlanService {
        public function deleteMembershipPlan (MembershipPlan $membershipPlan){
            return DB::transaction (function  () use ($membershipPlan) {
                return $membershipPlan->delete();
                
            });
        }
    }
?>


