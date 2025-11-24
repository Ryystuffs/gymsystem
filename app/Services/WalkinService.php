<?php
    namespace App\Services;

    use App\Models\MembershipPlan;

    use Illuminate\Support\Facades\DB;
    use App\Models\WalkinSession;
    use App\Models\Payments;

    class WalkinService {
       public function createWalkinSession(array $data){
            return DB::transaction (function () use ($data) {


                $payments = Payments::create([
                    'amount' => $data['amount_paid'],
                    'payment_method' => $data['payment_method'],
                    'type' => 'Walk-in',
                    'created_at' => now(),
                    ]);
                
                return WalkinSession::create([
                    'name' => $data['name'],
                    'check_in' => $data['check_in'],
                    'amount_paid' => $data['amount_paid'],
                    'payment_id' => $payments->id,
                    'created_at' => $data['check_in'],
                ]);
            });
        }

        public function updateWalkinSession(WalkinSession $walkinSession, array $data){
            return DB::transaction(function () use ($walkinSession, $data){
                $walkinSession->update([
                    'name' => $data['name'],
                    'amount_paid' => $data ['amount_paid']
                ]);

                if (!empty($data['payment_id'])){
                    Payments::where('id', $data['payment_id'])->update([
                        'amount' => $data['amount_paid'],
                    ]);
                }
                return $walkinSession;
            });
        }

        public function checkoutWalkinSession(WalkinSession $walkinSession){

            return DB::transaction(function () use ($walkinSession) {
                if ($walkinSession->check_out !== null) {
                    throw new \Exception('already_checked_out');
                }
                $walkinSession->update([
                    'check_out' => now(),
                ]);
                return $walkinSession;
            });
        }
    }
?>