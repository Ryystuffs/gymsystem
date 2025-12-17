<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\AccountService;

class createAccountController extends Controller
{

    protected $accountService;
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {

        $query = User::query();

        // Filter by name
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }

        // Filter by start date
        if ($request->filled('start')) {
            $query->whereDate('created_at', '>=', $request->start);
        }

        // Filter by end date
        if ($request->filled('end')) {
            $query->whereDate('created_at', '<=', $request->end);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->all());
        return view('admin.createAnAccount.accounts', [
            'users' => $users,
            'filters' => $request->only(['name', 'start', 'end']), // optional, for pre-filling inputs
        ]);
    }

    public function create()
    {
        return view('admin.createAnAccount.createAnAccount');
    }
    public function store(StoreAccountRequest $request)
    {
        $data = $request->validated();
        $this->accountService->createAccount($data);

        return redirect()->route('admin.createAnAccount.index')->with('success', 'Account Created Successfully');
    }
}
