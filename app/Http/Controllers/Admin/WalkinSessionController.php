<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWalkinRequest;
use App\Models\WalkinSession;
use App\Services\WalkinService;
use Illuminate\Http\Request;

class WalkinSessionController extends Controller
{   
    protected $walkinSession;
    public function __construct(WalkinService $walkinService)
    {
        $this->walkinSession = $walkinService;
    }
    //
    public function index(){
        $walkinSession = WalkinSession::orderBy('check_in', 'desc')->paginate(10);
        return view('admin.walkin.walkinSession', ['walkinSessions' => $walkinSession]);
    }

    public function create(){
        return view('admin.walkin.createWalkin');
    }

    public function store(StoreWalkinRequest $request){
        $data = $request->validated();
        $this->walkinSession->createWalkinSession($data);
        return redirect()->route('admin.walkin.index')->with('success', 'Walkin Session Created');
    }

    public function checkout(WalkinSession $walkinSession){
        $this->walkinSession->checkoutWalkinSession($walkinSession);
        return redirect()->route('admin.walkin.index')->with('success', 'Walk In Guest checkout');
    }
}
