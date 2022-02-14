<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollMaster extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'staff_id', 'tag_line', 'payroll_head','due_date','amount','status'];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id');
    }

    public function paySalary()
    {
        return $this->hasMany(SalaryPay::class, 'salary_masters_id');
    }
}
