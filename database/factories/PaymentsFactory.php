<?php

namespace Database\Factories;
use App\Models\WalkinSession;
use App\Models\User;
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
            $user = User::inRandomOrder()->first();
            $usermemberships = $user->userMemberships()->latest()->first();
            return [
                'user_id' => $user->id,
                'amount' => $usermemberships && $usermemberships->membershipPlan 
                    ? $usermemberships->membershipPlan->price 
                    : 0,
                'membership_plan_id' => $usermemberships ? $usermemberships->membership_plan_id : null,
                'created_at' => $usermemberships ? $usermemberships->created_at : now(),
                'payment_method' => $this->faker->randomElement(['Gcash', 'Cash']),
                'type' => $usermemberships ? 'Membership' : 'Walk-In',
            ];

    }   
}