<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <!-- Welcome Section -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-semibold text-blue-600">Welcome to the Empower HR System</h1>
        <p class="text-lg text-gray-700 mt-2">Manage your employees efficiently with our Payroll and Performance Evaluation Modules.</p>
    </div>

    <!-- Key Features Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Payroll Management Card -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-medium text-blue-600">Payroll Management</h2>
            <p class="text-gray-600 mt-2">Easily manage employee salaries, deductions, and generate reports. Everything you need for payroll processing in one place.</p>
            <a href="{{ route('payroll.index') }}" class="text-blue-600 hover:text-blue-800 mt-4 inline-block">Learn More</a>
        </div>

        <!-- Performance Evaluation Card -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-medium text-blue-600">Performance Evaluation</h2>
            <p class="text-gray-600 mt-2">Track employee performance, set goals, and generate reviews to help improve productivity and satisfaction.</p>
            <a href="{{ route('performance.index') }}" class="text-blue-600 hover:text-blue-800 mt-4 inline-block">Learn More</a>
        </div>

        <!-- Employee Records Card -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-medium text-blue-600">Employee Records</h2>
            <p class="text-gray-600 mt-2">Store and manage employee records, including personal details, job roles, and more for easy access and updates.</p>
            <a href="{{ route('employee.index') }}" class="text-blue-600 hover:text-blue-800 mt-4 inline-block">Learn More</a>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="mt-12 text-center">
        <h3 class="text-2xl font-semibold text-blue-600">Ready to get started?</h3>
        <p class="text-lg text-gray-700 mt-2">Sign in or register to begin managing your HR system.</p>
        <a href="{{ route('login') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Sign In</a>
    </div>
</div>
@endsection
