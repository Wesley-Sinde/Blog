<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'semesters_id', 'subjects_id', 'title','description','file', 'status'];
}
