<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WalkinSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments>
 */
class PaymentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $walkinSession = null;
        $user = null;
        if ($this->faker->boolean(70))  // 70% chance of being a membership payment
        {
            $walkinSession = WalkinSession::inRandomOrder()->first();
        } else {
            $user = User::inRandomOrder()->first();
        }
        $usermemberships = $user ? $user->userMemberships()->latest()->first() : null;
        return [
            'user_id' => $user ? $user->id : null,
            'amount' => $usermemberships && $usermemberships->membershipPlan ? $usermemberships->membershipPlan->price : 0,
            'membership_plans_id' => $usermemberships ? $usermemberships->membership_plan_id : null,
            'created_at' => $usermemberships ? $usermemberships->created_at : now(),
            'payment_method' => $this->faker->randomElement(['Gcash', 'Cash']),
            'type' => $usermemberships ? 'Membership' : 'Walk-in',
            'walkin_session_id' => $walkinSession ? $walkinSession->id : null,
        ];
    }
}
