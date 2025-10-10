<?php

namespace Database\Seeders;

use App\Models\WalkinSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalkinSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WalkinSession::factory()->count(50)->create();
    }
}
