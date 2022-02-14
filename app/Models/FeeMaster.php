<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeMaster extends BaseModel
{
    protected $table = 'fee_masters';
    protected $fillable = ['created_by', 'last_updated_by', 'students_id', 'semester', 'fee_head','fee_due_date','fee_amount','status'];

    public function students()
    {
        return $this->belongsTo(Student::class, 'students_id');
    }

    public function feeCollect()
    {
        return $this->hasMany(FeeCollection::class, 'fee_masters_id', 'id');
    }


}

