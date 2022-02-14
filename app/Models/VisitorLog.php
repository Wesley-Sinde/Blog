<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorLog extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'date', 'purpose', 'name', 'phone', 'email', 'id_doc', 'id_num', 'in_time', 'out_time', 'token', 'note', 'attachment', 'status'];
}
