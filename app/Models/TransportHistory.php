<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportHistory extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'years_id', 'routes_id', 'vehicles_id', 'travellers_id','history_type', 'status'];
}
