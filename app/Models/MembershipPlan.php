<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
    ];
    /** @use HasFactory<\Database\Factories\MembershipPlanFactory> */
    use HasFactory;
}
