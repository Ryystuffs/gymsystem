<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MembershipPlan extends Model
{
    /** @use HasFactory<\Database\Factories\MembershipPlanFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'price', 'duration', 'description'];


    public function userMemberships()
    {
        return $this->hasMany(UserMemberships::class);
    }

    public function payments()
    {
        return $this->hasMany(Payments::class);
    }
}
