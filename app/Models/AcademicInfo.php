<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicInfo extends Model
{
    protected $fillable = ['created_by', 'last_updated_by', 'students_id', 'institution', 'board','pass_year','symbol_no',
        'percentage', 'division_grade', 'major_subjects', 'remark', 'sorting_order','status'];

}
