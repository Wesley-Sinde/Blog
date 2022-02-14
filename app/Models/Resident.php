<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'hostels_id', 'rooms_id', 'beds_id', 'register_date', 'leave_date', 'user_type', 'member_id','status'];

    public function residentHistory()
    {
        return $this->hasMany(ResidentHistory::class, 'residents_id');
    }
}
