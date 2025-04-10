@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Payroll Management</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Employee Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Position</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Basic Salary</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Deductions</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Net Pay</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr class="border-t border-gray-200">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $employee->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $employee->position }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ number_format($employee->basic_salary, 2) }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ number_format($employee->deductions, 2) }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ number_format($employee->net_pay, 2) }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        <a href="{{ route('payroll.edit', $employee->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
