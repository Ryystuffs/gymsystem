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

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // ------------------------------
        // 1. Get membership plan stats
        // ------------------------------
        $planLabels = MembershipPlan::pluck('name')->toArray();
        $plans = count($planLabels);

        $perPlan = UserMemberships::selectRaw('membership_plan_id, COUNT(*) as total')
            ->groupBy('membership_plan_id')
            ->pluck('total', 'membership_plan_id')
            ->toArray();

        // ------------------------------
        // 2. Today's sessions (pie chart)
        // ------------------------------
        $memberSession = MemberSessions::whereDate('check_in', today())->count();
        $walkin = WalkinSession::whereDate('check_in', today())->count();
        $sessions = [$memberSession, $walkin];

        // ------------------------------
        // 3. Basic metrics
        // ------------------------------
        $members = UserMemberships::where('is_active', true)->count();
        $user = User::count();

        // ------------------------------
        // 4. Monthly Revenue
        // ------------------------------
        $revenue = Payments::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $monthlyRevenue = [];
        $total = 0;

        for ($i = 1; $i <= 12; $i++) {
            $value = $revenue[$i] ?? 0;
            $monthlyRevenue[] = $value;
            $total += $value;
        }

        // ---------------------------------------
        // 5. DAILY SESSION REPORT (calendar-style)
        // ---------------------------------------

        // If user selected month, use it; otherwise current month
        $selectedMonth = $request->input('month')
            ? Carbon::parse($request->input('month'))
            : Carbon::now();

        $month = $selectedMonth->month;
        $year = $selectedMonth->year;

        // How many days are in the selected month?
        $daysInMonth = $selectedMonth->daysInMonth;

        // Fetch Member sessions grouped by DAY
        $memberDaily = MemberSessions::selectRaw('DAY(check_in) as day, COUNT(*) as total')
            ->whereMonth('check_in', $month)
            ->whereYear('check_in', $year)
            ->groupBy('day')
            ->pluck('total', 'day');

        // Fetch Walk-in sessions grouped by DAY
        $walkinDaily = WalkinSession::selectRaw('DAY(check_in) as day, COUNT(*) as total')
            ->whereMonth('check_in', $month)
            ->whereYear('check_in', $year)
            ->groupBy('day')
            ->pluck('total', 'day');

        // Merge into total sessions per day
        $dailySessions = [];
        $labels = [];

        for ($d = 1; $d <= $daysInMonth; $d++) {
            $labels[] = $d;
            $dailySessions[] = ($memberDaily[$d] ?? 0) + ($walkinDaily[$d] ?? 0);
        }

        // Send all data to the view
        return view('admin.dashboard', [
            'monthlyRevenue' => $monthlyRevenue,
            'total' => $total,
            'members' => $members,
            'user' => $user,
            'plans' => $plans,
            'sessions' => $sessions,
            'planLabels' => $planLabels,
            'perPlan' => $perPlan,

            // NEW Daily Session Data
            'labels' => $labels,
            'dailySessions' => $dailySessions,
            'selectedMonth' => $selectedMonth->format('Y-m'),
        ]);
    }
}
