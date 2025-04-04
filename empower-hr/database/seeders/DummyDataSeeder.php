<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Create a department
        $department = Department::firstOrCreate(['name' => 'Engineering']);

        // Create two employees
        $employee1 = Employee::create([
            'name'          => 'John Doe',
            'email'         => 'john.doe@example.com',
            'phone'         => '1234567890',
            'department_id' => $department->id,
            'designation'   => 'Software Developer',
            'date_of_joining' => Carbon::now()->subYear()->format('Y-m-d'),
            'status'        => 'Active'
        ]);

        $employee2 = Employee::create([
            'name'          => 'Jane Smith',
            'email'         => 'jane.smith@example.com',
            'phone'         => '0987654321',
            'department_id' => $department->id,
            'designation'   => 'QA Engineer',
            'date_of_joining' => Carbon::now()->subMonths(6)->format('Y-m-d'),
            'status'        => 'Active'
        ]);

        // Create payroll records for the employees
        Payroll::create([
            'employee_id'   => $employee1->id,
            'basic_salary'  => 5000,
            'deductions'    => 200,
            'bonuses'       => 100,
            'net_salary'    => 4900,
            'payment_date'  => Carbon::now()->format('Y-m-d'),
        ]);

        Payroll::create([
            'employee_id'   => $employee2->id,
            'basic_salary'  => 4000,
            'deductions'    => 150,
            'bonuses'       => 150,
            'net_salary'    => 4000,
            'payment_date'  => Carbon::now()->format('Y-m-d'),
        ]);

        // Create attendance records
        Attendance::create([
            'employee_id'   => $employee1->id,
            'date'          => Carbon::now()->format('Y-m-d'),
            'check_in_time' => '09:00:00',
            'check_out_time'=> '17:00:00',
            'status'        => 'Present'
        ]);

        Attendance::create([
            'employee_id'   => $employee2->id,
            'date'          => Carbon::now()->format('Y-m-d'),
            'check_in_time' => '09:15:00',
            'check_out_time'=> '17:05:00',
            'status'        => 'Late'
        ]);
    }
}
