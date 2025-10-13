<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WalkinSession;
class Payments extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentsFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'amount', 'payment_method', 'type', 'created_at', 'membership_plan_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class,);
    }
    public function walkinSession(){

        return $this->hasOne(WalkinSession::class, 'payment_id');
    }

}
