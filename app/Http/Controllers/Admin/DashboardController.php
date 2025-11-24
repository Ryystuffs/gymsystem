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

        $perPlan = UserMemberships::selectRaw('membership_plan_id, COUNT(*) as total')
            ->groupBy('membership_plan_id')
            ->get()
            ->pluck('total', 'membership_plan_id')
            ->toArray();

        $memberSession = MemberSessions::whereDate('check_in', now())->count();
        $walkin = WalkinSession::whereDate('check_in', now())->count();

        

        $sessions = [$memberSession, $walkin];
        $members = UserMemberships::where('is_active', true)->count();
        $user = User::count();
        $revenue = Payments::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month');
        $monthlyRevenue = [];
        $total = 0;

        for ($i = 1; $i <= 12; $i++) {
            $monthlyRevenue[] = $revenue[$i] ?? 0;
            $total = $total += $revenue[$i] ?? 0;
        }
        $perMember = MemberSessions::selectRaw('DAYOFWEEK(check_in) as day, COUNT(*) as total')
            ->whereBetween('check_in', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('day')
            ->get()
            ->pluck('total', 'day');
        $perWalkin = WalkinSession::selectRaw('DAYOFWEEK(check_in) as day, COUNT(*) as total')
            ->whereBetween('check_in', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('day')
            ->get()
            ->pluck('total', 'day');
        $totalSessions = [];
        for ($i = 1; $i <= 7; $i++) {
            $totalSessions[] = ($perMember[$i] ?? 0) + ($perWalkin[$i] ?? 0);
        }
        return view('admin.dashboard', [
            'monthlyRevenue' => $monthlyRevenue,
            'total' => $total,
            'members' => $members,
            'user' => $user,
            'plans' => $plans,
            'sessions' => $sessions,
            'planLabels' => $planLabels,
            'perPlan' => $perPlan,
            'totalSessions' => $totalSessions,
        ]);
    }
}
