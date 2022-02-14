<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends BaseModel
{
    //
    protected $fillable = ['created_by', 'last_updated_by','member_type', 'member_id', 'subject', 'note', 'status'];
}
