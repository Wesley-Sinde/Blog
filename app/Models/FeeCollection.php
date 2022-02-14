<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeCollection extends BaseModel
{
    //
    protected $table = 'fee_collections';
    protected $fillable = ['created_by', 'last_updated_by', 'students_id', 'fee_masters_id', 'date', 'discount', 'fine', 'paid_amount','payment_mode','note','response','status'];

    public function feeMasters()
    {
        return $this->belongsTo(FeeMaster::class, 'fee_masters_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class, 'students_id');
    }
}
