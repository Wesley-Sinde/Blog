<?php
namespace App\Traits;

use App\Models\AttendanceStatus;
use App\Models\GradingType;
use App\Models\StudentStatus;
use App\Models\Subject;

trait AcademicScope{

    public function getGradingTitle($id)
    {
        $grading = GradingType::find($id);
        if ($grading) {
            return $grading->title;
        }else{
            return "Unknown";
        }
    }

    public function getAcademicStatus($id)
    {
        $status = StudentStatus::find($id);
        if ($status) {
            return $status->title;
        }else{
            return "Unknown";
        }
    }

    public function getAttendanceFullStatus($id)
    {
        $status = AttendanceStatus::find($id);
        if ($status) {
            return strtoupper($status->title);
        }else{
            return "-";
        }
    }

    public function getAttendanceStatus($id)
    {
        $status = AttendanceStatus::find($id);
        if ($status) {
            return strtoupper(substr($status->title,'0','2'));
        }else{
            return "-";
        }
    }

    public function getAttendanceDisplayClass($id)
    {
        $status = AttendanceStatus::find($id);
        if ($status) {
            return $status->display_class;
        }else{
            return "";
        }
    }

    public function allSubjectsList()
    {
        $subjects = Subject::Active()->orderBy('title')->pluck('title','id')->toArray();
        return array_prepend($subjects,'Select Subject','0');
    }

}