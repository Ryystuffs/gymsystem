<?php
    namespace App\Services;

    use App\Models\MembershipPlan;

    use Illuminate\Support\Facades\DB;
    use App\Models\WalkinSession;
    use App\Models\Payments;

    class WalkinService {
       public function createWalkinSession(array $data){
            return DB::transaction (function () use ($data) {


                Payments::create([
                    'amount' => $data['amount_paid'],
                    'payment_method' => $data['payment_method'],
                    'type' => 'Walk-in',
                    'created_at' => now(),
                    ]);
                return WalkinSession::create([
                    'name' => $data['name'],
                    'check_in' => $data['check_in'],
                    'amount_paid' => $data['amount_paid'],
                    'payment_id' => Payments::latest()->first()->id,
                    'created_at' => $data['check_in'],
                ]);
            });
        }
    }
?>