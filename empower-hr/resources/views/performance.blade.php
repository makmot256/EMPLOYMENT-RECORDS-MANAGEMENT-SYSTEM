@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Performance Evaluation</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Employee Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Position</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Evaluation Period</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Rating</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Comments</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($evaluations as $evaluation)
                <tr class="border-t border-gray-200">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $evaluation->employee->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $evaluation->employee->position }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $evaluation->evaluation_period }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $evaluation->rating }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $evaluation->comments }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        <a href="{{ route('performance.edit', $evaluation->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

