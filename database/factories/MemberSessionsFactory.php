<?php

namespace Database\Factories;

use App\Models\UserMemberships;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MemberSessions>
 */
class MemberSessionsFactory extends Factory
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

            'user_membership_id' => UserMemberships::inRandomOrder()->first()->id,
            'check_in' => now(),
            'check_out' => now()->addHours(rand(2,5)),
        ];
    }
}
