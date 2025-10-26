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
    public function __construct( AccountService $accountService)
    {
        $this->accountService = $accountService;
    }
     /**
     * Display a listing of the resource.
     */

    public function index(){
        $users = User::paginate(10);
        return view('admin.createAnAccount.accounts', [ 'users' => $users ]);
    }
    public function create(){
        return view('admin.createAnAccount.createAnAccount');
    }
    public function store(StoreAccountRequest $request){
        $data = $request->validated();
        $this->accountService->createAccount($data);

        return redirect()->route('admin.createAnAccount.index')->with('success', 'Account Created Successfully');
    }
}
