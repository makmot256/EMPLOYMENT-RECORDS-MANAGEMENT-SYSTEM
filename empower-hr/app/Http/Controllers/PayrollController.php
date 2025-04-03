<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        return response()->json(Payroll::with('employee')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'basic_salary' => 'required|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'bonuses' => 'nullable|numeric|min:0',
            'net_salary' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        $payroll = Payroll::create($request->all());
        return response()->json($payroll, 201);
    }

    public function show($id)
    {
        return response()->json(Payroll::with('employee')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->update($request->all());
        return response()->json($payroll);
    }

    public function destroy($id)
    {
        Payroll::destroy($id);
        return response()->json(null, 204);
    }
}
