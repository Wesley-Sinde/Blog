<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'title', 'rent', 'description', 'status'];

    public function vehicle(){
        return $this->belongsToMany(Vehicle::class, 'route_vehicles', 'routes_id', 'vehicles_id');
    }
}

