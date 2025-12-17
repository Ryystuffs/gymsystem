<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberSessions;

class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $query = memberSessions::query();

        // Filter by name
        if ($request->filled('name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'LIKE', "%{$request->name}%");
            });
        }

        // Filter by start date
        if ($request->filled('start')) {
            $query->whereDate('check_in', '>=', $request->start);
        }

        // Filter by end date
        if ($request->filled('end')) {
            $query->whereDate('check_out', '<=', $request->end);
        }

        $memberSessions = $query->orderBy('check_in','desc')->paginate(10)->appends($request->all());
        return view('admin.sessions.memberSessions', [ 
            'memberSessions' => $memberSessions,
            'filters' => $request->only(['name', 'start', 'end']), // optional, for pre-filling inputs
         ]);
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
        $query = $request->input('q');
        $filters = $request->input('filters');

        
        $memberSessions = MemberSessions::with(['userMembership.user'])
            ->whereHas('userMembership.user', function ($q2) use ($query){
                $q2->where('name', 'LIKE', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends([
                'q' => $query,
                'filters' => $filters,
            ]);

        return view('admin.sessions.memberSessions', ['memberSessions' => $memberSessions]);
    }
}
