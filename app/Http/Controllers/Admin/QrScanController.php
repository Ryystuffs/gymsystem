<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberSessions;
use App\Models\MembershipPlan;
use App\Models\User;
use App\Models\UserMemberships;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QrScanController extends Controller
{
    //
    public function scanner()
    {
        return view('admin.scan.scanner');
    }

    public function handle(User $user)
    {
        // Find the user's active membership
        $membership = UserMemberships::where('user_id', $user->id)
            ->where('is_active', true)
            ->first();

        if (! $membership) {
            return redirect()->route('admin.sessions.index')->with(['error' => 'No active membership found.'], 404);
        }

        // Check if there’s an open session (no check_out time)
        $openSession = MemberSessions::where('user_membership_id', $membership->id)
            ->whereNull('check_out')
            ->first();

        if (! $openSession) {
            // Create new check-in session
            MemberSessions::create([
                'user_membership_id' => $membership->id,
                'check_in' => Carbon::now(),
            ]);

            return redirect()->route('admin.sessions.index')->with(['message' => 'Check-in recorded successfully.']);
        } else {
            // Mark existing session as checked out
            $openSession->update([
                'check_out' => Carbon::now(),
            ]);

            return redirect()->route('admin.sessions.index')->with(['message' => 'Check-out recorded successfully.']);
        }
    }

}
