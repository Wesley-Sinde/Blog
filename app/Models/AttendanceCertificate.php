<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceCertificate extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'students_id', 'date_of_issue', 'year_of_study',
        'percentage_of_attendance','ref_text','status'];

}
