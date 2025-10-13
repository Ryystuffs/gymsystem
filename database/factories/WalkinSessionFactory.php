<?php

namespace Database\Factories;

use App\Models\Payments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WalkinSession>
 */
class WalkinSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    $checkIn = now();
    $checkOut = (clone $checkIn)->addHours(fake()->numberBetween(1, 5));
    
    // Create a payment record first
    $payment = Payments::factory()->create([
        'user_id' => null,
        'amount' => 80,
        'membership_plan_id' => null,
        'created_at' => $checkIn,
        'payment_method' => fake()->randomElement(['Gcash', 'Cash']),
        'type' => 'Walk-in'
    ]);

    return [
        'name' => fake()->name(),
        'check_in' => $checkIn,
        'check_out' => $checkOut,
        'amount_paid' => 80,
        'created_at' => $checkIn,
        'payment_id' => $payment->id
    ];
    }
}
