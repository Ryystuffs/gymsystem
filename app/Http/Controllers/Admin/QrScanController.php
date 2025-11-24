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
        $now = Carbon::now();

        $membership = UserMemberships::where('user_id', $user->id)
            ->where('is_active', true)
            ->first();
        if (! $membership) {
            return response()->json([
                'status' => 'error',
                'message' => 'no active membership, create one first.'
            ]);
        }

        if ($now->greaterThan($membership->expired_at)) {
            $membership->update([
                'is_active' => false
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Membership expired'
            ]);
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

            return response()->json([
                'status' => 'success',
                'type' => 'check-in',
                'message' =>  $membership->user->name . ' Check-in successfully'
            ]);
        } else {
            // Mark existing session as checked out
            $openSession->update([
                'check_out' => Carbon::now(),
            ]);
            return response()->json([
                'status' => 'success',
                'type' => 'check-out',
                'message' =>  $membership->user->name . ' Check-out successfully'
            ]);
        }
    }
}
