<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Http\Request;

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

    public function search(Request $request)
    {
        $query = $request->input('q');
        $filters = $request->input('filters');

        $payments = Payments::with(['user', 'walkinSession', 'membershipPlan'])
            ->where(function ($q) use ($query, $filters) {

                if (!empty($query)) {
                    $q->whereHas('user', function ($w) use ($query) {
                        $w->where('name', 'LIKE', "%{$query}%");
                    })
                        ->orWhereHas('walkinSession', function ($x) use ($query) {
                            $x->where('name', 'LIKE', "%{$query}%");
                        });
                }

                if (!empty($filters)) {
                    $q->where('type', 'LIKE', "%{$filters}%");
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends([
                'q' => $query,
                'filters' => $filters,
            ]);

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
}
