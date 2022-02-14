<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostalExchange extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'type', 'date', 'ref_no', 'subject', 'to', 'from', 'note', 'attachment', 'status'];
}
