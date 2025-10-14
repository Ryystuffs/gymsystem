<?php

namespace Database\Seeders;

use App\Models\MemberSessions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MemberSessions::factory()->count(30)->create();
    }
}
