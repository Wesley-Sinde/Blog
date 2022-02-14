<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = ['created_by', 'last_updated_by', 'title', 'message',  'publish_date', 'end_date',
        'display_group','status'];
}
