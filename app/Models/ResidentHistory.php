<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResidentHistory extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'years_id','hostels_id', 'rooms_id', 'beds_id', 'residents_id','history_type', 'status'];

}
