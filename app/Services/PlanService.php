<?php
    namespace App\Services;

    use App\Models\MembershipPlan;
use Faker\Provider\ar_EG\Payment;
use App\Models\Payments;
use Illuminate\Support\Facades\DB;

    class PlanService {
        public function deleteMembershipPlan (MembershipPlan $membershipPlan){
            return DB::transaction (function  () use ($membershipPlan) {
                return $membershipPlan->delete();
                
            });
        }
        
        public function createMembershipPlan(array $data){
            return DB::transaction (function () use ($data) {
                return MembershipPlan::create($data);
            });
        }

        public function updateMembershipPlan(MembershipPlan $membershipPlan, array $data){
            return DB::transaction (function () use ($membershipPlan, $data) {
                $membershipPlan->update($data);
                return $membershipPlan;
            });
        }
    }
?>


