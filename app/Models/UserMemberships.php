<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\MembershipPlan;
use App\Models\MemberSessions;

class UserMemberships extends Model
{
    /** @use HasFactory<\Database\Factories\UserMembershipsFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'membership_plan_id', 'expired_at', 'is_active', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class);
    }

    public function memberSessions()
    {
        return $this->hasMany(MemberSessions::class);
    }
}
