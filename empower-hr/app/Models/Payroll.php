<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $table = 'payroll';
    protected $fillable = ['employee_id', 'basic_salary', 'deductions', 'bonuses', 'net_salary', 'payment_date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
