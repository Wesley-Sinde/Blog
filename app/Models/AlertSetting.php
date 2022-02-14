<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlertSetting extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'event', 'sms', 'email', 'subject', 'template', 'status'];
}
