<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberSessions;
use App\Models\MembershipPlan;
use App\Models\Payments;
use App\Models\User;
use App\Models\UserMemberships;
use App\Models\WalkinSession;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class DashboardController extends Controller
{
    public function index()
    {
        $planLabels = MembershipPlan::pluck('name')->toArray();
        $plans = count($planLabels);
        $plans = MembershipPlan::count();

        $members = UserMemberships::where('is_active', true)->count();
        $user = User::count();
        $revenue = Payments::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month');
        $memberSession = MemberSessions::whereDate('check_in', now())->count();
        $walkin = WalkinSession::whereDate('check_in', now())->count();


        $sessions = [$memberSession, $walkin];
        $monthlyRevenue = [];
        $total = 0;

        for ($i = 1; $i <= 12; $i++) {
            $monthlyRevenue[] = $revenue[$i] ?? 0;
            $total = $total += $revenue[$i] ?? 0;
        }
        return view('admin.dashboard', [
            'monthlyRevenue' => $monthlyRevenue,
            'total' => $total,
            'members' => $members,
            'user' => $user,
            'plans' => $plans,
            'sessions' => $sessions,
            'planLabels' => $planLabels
        ]);
    }
}