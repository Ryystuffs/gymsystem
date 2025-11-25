<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWalkinRequest;
use App\Models\WalkinSession;
use App\Services\WalkinService;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateWalkinSessionRequest;

class WalkinSessionController extends Controller
{
    protected $walkinSession;
    public function __construct(WalkinService $walkinService)
    {
        $this->walkinSession = $walkinService;
    }
    //
    
    public function index(Request $request)
    {
        $query = WalkinSession::query();

        // Filter by name
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }

        // Filter by start date
        if ($request->filled('start')) {
            $query->whereDate('check_in', '>=', $request->start);
        }

        // Filter by end date
        if ($request->filled('end')) {
            $query->whereDate('check_in', '<=', $request->end);
        }

        // Order and paginate
        $walkinSessions = $query->orderBy('check_in', 'desc')->paginate(10)->appends($request->all());

        return view('admin.walkin.walkinSession', [
            'walkinSessions' => $walkinSessions,
            'filters' => $request->only(['name', 'start', 'end']), // optional, for pre-filling inputs
        ]);
    }

    public function create()
    {
        return view('admin.walkin.createWalkin');
    }
    public function update(WalkinSession $walkinSession, UpdateWalkinSessionRequest $request)
    {
        $data = $request->validated();
        $this->walkinSession->updateWalkinSession($walkinSession, $data);
        return redirect()->route('admin.walkin.index')->with('success', 'Edited Successfully');
    }

    public function store(StoreWalkinRequest $request)
    {
        $data = $request->validated();
        $this->walkinSession->createWalkinSession($data);
        return redirect()->route('admin.walkin.index')->with('success', 'Guest Added Successfully');
    }

    public function checkout(WalkinSession $walkinSession)
    {
        try {
            $userName = $walkinSession->name;
            $this->walkinSession->checkoutWalkinSession($walkinSession);
            return redirect()->route('admin.walkin.index')->with('checkout', "$userName Successfully CheckOut");
        } catch (\Exception $e) {
            if ($e->getMessage() === 'already_checked_out') {
                return redirect()->route('admin.walkin.index')->with('error', "$userName Already Checked Out");
            }
            return redirect()->route('admin.walkin.index')->with('error', 'An error occurred during checkout');
        }
    }
    public function search(Request $request)
    {
        $query = $request->input('q');
        $filters = $request->input('filters');

        $walkinSessions = WalkinSession::where('name', 'LIKE', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends([
                'q' => $query,
                'filters' => $filters,
            ]);

        return view('admin.walkin.walkinSession', ['walkinSessions' => $walkinSessions]);
    }
}
    