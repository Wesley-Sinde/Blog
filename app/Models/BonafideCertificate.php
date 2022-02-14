<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BonafideCertificate extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'students_id', 'date_of_issue', 'course', 'period', 'character', 'ref_text','status'];
}
