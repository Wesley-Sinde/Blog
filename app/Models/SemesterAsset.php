<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SemesterAsset extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'semesters_id', 'assets_id', 'quantity', 'status'];
}
