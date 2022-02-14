<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bed extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'hostels_id', 'rooms_id', 'bed_number', 'bed_status'];

    public function room()
    {
        return $this->belongsTo(Room::class, 'id');
    }
}
