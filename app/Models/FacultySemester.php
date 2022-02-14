<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultySemester extends BaseModel
{
    Protected $table = 'faculty_semester';
    protected $fillable = ['faculty_id','semester_id'];
}
