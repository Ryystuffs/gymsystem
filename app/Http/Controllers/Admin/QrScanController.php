<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberSessions;
use App\Models\User;
use App\Models\UserMemberships;
use Illuminate\Http\Request;

class QrScanController extends Controller
{
    //

    public function handle(User $user)
    {
        // Logic to handle QR scan for the user with the given ID
        // For example, you might want to log the scan or update user status
        User::findOrFail($user);
        // Log the scan or update user status here
        if (!UserMemberships::where('user_id', $user->id)->where('is_active', true)->exists()) {
            return response()->json(['message' => 'User does not have an active membership.'], 403);
        }else{
            if (MemberSessions::where('user_membership_id', UserMemberships::where('user_id', $user->id)->where('is_active', true)->first()->id)->whereNull('check_in')->exists()) {
                $session = MemberSessions::where('user_membership_id', UserMemberships::where('user_id', $user->id)->where('is_active', true)->first()->id)->whereNull('check_in')->first();
                $session->check_in = now();
                $session->save();
                return response()->json(['message' => "User ID: {$user->id} checked in at {$session->check_in}"]);
            }else {
                $session = MemberSessions::where('user_membership_id', UserMemberships::where('user_id', $user->id)->where('is_active', true)->first()->id)->whereNull('check_out')->first();
                $session->check_out = now();
                $session->save();
                return response()->json(['message' => "User ID: {$user->id} checked out at {$session->check_out}"]);
            }
        }
        return response()->json(['message' => "QR code scanned for user ID: {$user->id}"]);
    }
}
