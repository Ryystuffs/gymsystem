<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\MembershipPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserMemberships>
 */
class UserMembershipsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $membershipPlan = MembershipPlan::inRandomOrder()->first();

        $valid = now()->addDays($membershipPlan->duration);
        return [
            //
            'user_id' => User::inRandomOrder()->first()->id,
            'membership_plan_id' => $membershipPlan->id,
            'created_at' => now(),
            'expired_at' => $valid,
            'is_active' => now()->lt($valid) ,
        ];
    }
}
