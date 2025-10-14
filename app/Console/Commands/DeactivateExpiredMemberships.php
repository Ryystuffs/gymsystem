<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserMemberships;

use Carbon\Carbon;

class DeactivateExpiredMemberships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deactivate-expired-memberships';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $now = Carbon::now();

        // Update all memberships that are expired and still active
        $count = UserMemberships::where('expired_at', '<', $now)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        $this->info("Deactivated {$count} expired memberships.");
    }
}
