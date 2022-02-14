<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsEmail extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'subject', 'message',
        'sms', 'email', 'group', 'status'];
}
