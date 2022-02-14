<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'title', 'status'];
}
