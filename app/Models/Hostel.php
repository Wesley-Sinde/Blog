<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hostel extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'name', 'type', 'address', 'contact_detail', 'warden',
                            'warden_contact','description', 'status'];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'hostels_id');
    }

    public function beds()
    {
        return $this->hasMany(Bed::class, 'hostels_id');
    }
}
