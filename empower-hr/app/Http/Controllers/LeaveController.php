<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        return response()->json(Leave::with('employee')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        $leave = Leave::create($request->all());
        return response()->json($leave, 201);
    }

    public function show($id)
    {
        return response()->json(Leave::with('employee')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update($request->all());
        return response()->json($leave);
    }

    public function destroy($id)
    {
        Leave::destroy($id);
        return response()->json(null, 204);
    }
}
