<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WalkinSession;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payments::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.payments.paymentRecords', ['payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function search(Request $request)
    {
        $query = Payments::query();

        // Filter by payment type (Membership or Walk-in)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Search by name (either from User or WalkinSession)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($u) use ($search) {
                    $u->where('name', 'like', "%{$search}%");
                })->orWhereHas('walkinSession', function ($w) use ($search) {
                    $w->where('name', 'like', "%{$search}%");
                });
            });
        }

        $payments = $query->orderBy('created_at', 'desc')->paginate(10);

        // If request is AJAX, return only table HTML (for dynamic update)
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.payments.partials.partialTable', compact('payments'))->render()
            ]);
        }

        // Otherwise load the full page
        return view('admin.payments.paymentRecords', compact('payments'));
    }
}
