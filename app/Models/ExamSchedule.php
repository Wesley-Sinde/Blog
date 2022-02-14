<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'years_id','months_id', 'exams_id', 'faculty_id','semesters_id', 'subjects_id',
        'date', 'start_time', 'end_time', 'full_mark_theory', 'pass_mark_theory', 'full_mark_practical',
        'pass_mark_practical','sorting_order', 'publish_status', 'status'];



    public function markLedger()
    {
        return $this->hasMany(ExamMarkLedger::class, 'exam_schedule_id','id');
    }


}
