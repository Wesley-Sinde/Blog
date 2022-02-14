<?php

namespace App\Models;

class AttendanceMaster extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'year', 'month', 'day_in_month','holiday','open','status'];

    public function year()
    {
        return $this->belongsTo(Year::class, 'year', 'id');
    }

    public function month()
    {
        return $this->belongsTo(Month::class, 'month', 'id');
    }

}
