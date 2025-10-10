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

        // Randomly decide if this is a walk-in or membership payment
        $isWalkin = fake()->boolean();

        if ($isWalkin) {
            $walkinSession = WalkinSession::inRandomOrder()->first();
            return [
                'user_id' => null,  // Walk-ins don't need user_id
                'amount' => $walkinSession ? $walkinSession->amount_paid : 80,
                'membership_plans_id' => null,  // Walk-ins don't have membership plans
                'created_at' => now(),
                'payment_method' => $this->faker->randomElement(['Gcash', 'Cash']),
                'type' => 'Walk-in'
            ];
        } else {
            $user = User::inRandomOrder()->first();
            $usermemberships = $user->userMemberships()->latest()->first();
            return [
                'user_id' => $user->id,
                'amount' => $usermemberships && $usermemberships->membershipPlan 
                    ? $usermemberships->membershipPlan->price 
                    : 0,
                'membership_plans_id' => $usermemberships ? $usermemberships->membership_plan_id : null,
                'created_at' => $usermemberships ? $usermemberships->created_at : now(),
                'payment_method' => $this->faker->randomElement(['Gcash', 'Cash']),
                'type' => 'Membership'
            ];
        }

    }   
}