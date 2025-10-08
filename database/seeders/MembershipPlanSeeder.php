<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MembershipPlan;
class MembershipPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MembershipPlan::query()->delete();


        // Insert consistent records
        MembershipPlan::insert([
            ['name' => 'Weekly', 'price' => 300, 'duration' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Basic', 'price' => 750, 'duration' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Standard', 'price' => 1200, 'duration' => 60, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Premium', 'price' => 2000, 'duration' => 90, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Annual', 'price' => 7000, 'duration' => 365, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
