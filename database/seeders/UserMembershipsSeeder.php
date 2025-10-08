<?php

namespace Database\Seeders;

use App\Models\UserMemberships;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserMembershipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        UserMemberships::factory()->count(50)->create();
    }
}
