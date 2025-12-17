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
    public function index(Request $request)
    {
        $query = Payments::query();

        // Filter by name (user OR walk-in)
        if ($request->filled('name')) {
            $name = $request->name;

            $query->where(function ($q) use ($name) {
                $q->whereHas('user', function ($user) use ($name) {
                    $user->where('name', 'LIKE', "%{$name}%");
                })
                    ->orWhereHas('walkinSession', function ($walkin) use ($name) {
                        $walkin->where('name', 'LIKE', "%{$name}%");
                    });
            });
        }

        // Filter by start date
        if ($request->filled('start')) {
            $query->whereDate('created_at', '>=', $request->start);
        }

        // Filter by end date
        if ($request->filled('end')) {
            $query->whereDate('created_at', '<=', $request->end);
        }

        // Filter by payment type (Membership / Walk-in)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by payment method (Cash / GCash)
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        // Order and paginate
        $payments = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends($request->all());

        return view('admin.payments.paymentRecords', [
            'payments' => $payments,
            'filters' => $request->only(['name', 'start', 'end', 'type', 'payment_method']), // optional, for pre-filling inputs
        ]);
    }

    public function search(Request $request)
    {
        /*
        $query = $request->input('q');
        $filters = $request->input('filters');

        $payments = Payments::with(['user', 'walkinSession'])
            ->where(function ($q) use ($query, $filters) {

                if (!empty($query)) {
                    $q->whereHas('user', function ($w) use ($query) {
                        $w->where('name', 'LIKE', "%{$query}%");
                    });
                    $q->orWhereHas('walkinSession', function ($x) use ($query) {
                        $x->where('name', 'LIKE', "%{$query}%");
                    });
                }

                if (!empty($filters)) {
                    $q->where('type', $filters);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends([
                'q' => $query,
                'filters' => $filters,
            ]);*/
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
