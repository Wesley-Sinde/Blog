<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'hostels_id','room_type','room_number', 'rate_perbed', 'description', 'status'];

    public function hostel()
    {
        return $this->belongsTo(Hostel::class, 'hostels_id');
    }

    public function beds()
    {
        return $this->hasMany(Bed::class, 'rooms_id');
    }
}
