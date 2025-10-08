<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    /** @use HasFactory<\Database\Factories\MembershipPlanFactory> */
    use HasFactory;
    protected $fillable = ['name', 'price', 'duration', 'description'];


    public function userMemberships()
    {
        return $this->hasMany(UserMemberships::class);
    }
}
