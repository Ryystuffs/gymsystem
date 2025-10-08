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
        return [
            //
            'user_id' => User::inRandomOrder()->first()->id,
            'membership_plan_id' => MembershipPlan::inRandomOrder()->first()->id,
            'expired_at' => $this->faker->dateTimeBetween('+1 month', '+1 year'),
            'created_at' => now(),
            'is_active' => $this->faker->boolean(80), // 80%
        ];
    }
}
