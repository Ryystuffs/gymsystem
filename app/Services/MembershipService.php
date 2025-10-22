<?php
    namespace App\Services;


    use App\Models\Payments;
    use App\Models\UserMemberships;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\DB;

    class MembershipService {

        public function createUserMemberships (array $validated)
        {

            return DB::transaction(function () use ($validated) {

                Payments::create([
                    'user_id' => $validated['user_id'],
                    'membership_plan_id' => $validated['membership_plan_id'],
                    'amount' => $validated['amount'],
                    'payment_method' => $validated['payment_method'],
                    'type' => 'Membership',
                    'created_at' => now(),
                    ]);
                    
                return UserMemberships::create([
                    'user_id' => $validated['user_id'],
                    'membership_plan_id' => $validated['membership_plan_id'],
                    'expired_at' => $validated['expired_at'],
                    'is_active' => true,
                    'created_at' => now(),
                ]);
            });
        }

        public function deleteUserMembership(UserMemberships $userMemberships){
            return DB::transaction(function () use ($userMemberships){
                $userMemberships->delete();
            });
        }

        public function updateUserMemberships(UserMemberships $userMemberships, array $data){
            return DB::transaction(function () use ($userMemberships, $data){
                
                Payments::create([
                    'user_id' => $data['user_id'],
                    'membership_plan_id' => $data['membership_plan_id'],
                    'amount' => $data['amount'],
                    'payment_method' => $data['payment_method'],
                    'type' => 'Membership',
                    'created_at' => now(),
                    ]);
                $userMemberships->update($data);    
                return $userMemberships;
            });
        }

        
    }

?>