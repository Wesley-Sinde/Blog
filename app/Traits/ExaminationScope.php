<?php
namespace App\Traits;

use App\Models\Exam;
use App\Models\ExamMarkLedger;
use App\Models\ExamSchedule;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Year;

trait ExaminationScope{

    public function activeExams()
    {
        $exams = Exam::Active()->orderBy('title')->pluck('title','id')->toArray();
        return array_prepend($exams,'Select Exams','0');
    }

    public function getExamById($id)
    {
        $exam = Exam::find($id);
        if ($exam) {
            return $exam->title;
        }else{
            return "Unknown";
        }
    }

    public function getSubjectById($id)
    {
        $subject = Subject::find($id);
        if ($subject) {
            return $subject->title;
        }else{
            return "Unknown";
        }
    }

    public function getSubjectCodeById($id)
    {
        $subject = Subject::find($id);
        if ($subject) {
            return $subject->code;
        }else{
            return "Unknown";
        }
    }

    public function getSubCreditById($id)
    {
        $subject = Subject::find($id);
        if ($subject) {
            return $subject->credit_hour;
        }else{
            return "Unknown";
        }
    }

    public function getGrade($semester, $percentage)
    {
        $score ="*MG";
        $gradingType = $semester->gradingType()->first();
        if(!$gradingType) return $score;
        $gradingScale = $gradingType->gradingScale()->get();

        foreach ($gradingScale as $grade){
            if($percentage > $grade->percentage_from && $percentage <= $grade->percentage_to){
                $score = $grade->name;
            }
        }
        return $score;
    }

    public function getPoint($semester, $percentage)
    {
        $score ="*MP";
        $gradingType = $semester->gradingType()->first();
        if(!$gradingType) return $score;
        $gradingScale = $gradingType->gradingScale()->get();
        foreach ($gradingScale as $grade){
            if($percentage > $grade->percentage_from && $percentage <= $grade->percentage_to){
                $score = $grade->grade_point;
            }
        }
        return $score;
    }

    public function getRemark($semester, $percentage)
    {
        $score ="";
        $gradingType = $semester->gradingType()->first();
        if(!$gradingType) return $score;
        $gradingScale = $gradingType->gradingScale()->get();
        foreach ($gradingScale as $grade){
            if($percentage >= $grade->percentage_from && $percentage <= $grade->percentage_to){
                $score = $grade->description;
            }
        }
        return $score;
    }

    public function getExamNameByScheduleId($id)
    {
        $examSchedule = ExamSchedule::find($id)->first();
        $exam = Exam::find($examSchedule->exams_id);
        if ($exam) {
            return $exam->title;
        }else{
            return "Unknown";
        }
    }

    public function getStudentRankingInExam($year, $month, $exam, $faculty, $semester,$studentId)
    {
        $year = $year;
        $month = $month;
        $exam = $exam;
        $faculty = $faculty;
        $semester = $semester;
        $studentId = $studentId;

        if($year && $month && $exam && $faculty && $semester) {
            $examScheduleCondition = [
                ['years_id', '=', $year],
                ['months_id', '=', $month],
                ['exams_id', '=', $exam],
                ['faculty_id', '=', $faculty],
                ['semesters_id', '=', $semester]
            ];

            /*Find Exam Schedule Id*/
            $examScheduleId = ExamSchedule::select('id')
                ->where($examScheduleCondition)
                ->get();
            $examScheduleId = array_pluck($examScheduleId, 'id');
            if(count($examScheduleId) > 0){
                $data['ledger_exist'] = ExamMarkLedger::select('exam_mark_ledgers.exam_schedule_id', 'exam_mark_ledgers.students_id',
                    'exam_mark_ledgers.obtain_mark_theory', 'exam_mark_ledgers.obtain_mark_practical', 'exam_mark_ledgers.absent_theory','exam_mark_ledgers.absent_practical',
                    'exam_mark_ledgers.status', 's.id as student_id', 's.reg_no', 's.first_name', 's.middle_name', 's.last_name',
                    's.last_name')
                    ->where('exam_mark_ledgers.exam_schedule_id', $examScheduleId)
                    ->join('students as s', 's.id', '=', 'exam_mark_ledgers.students_id')
                    ->orderBy('exam_mark_ledgers.students_id','asc')
                    ->get();
            }else{

            }

        }

        if($data['ledger_exist']){
            $data['exam_schedule_id'] = implode(',',$examScheduleId);
        }

        $exam_schedule_id = $examScheduleId;
        $student_id = $data['ledger_exist']->pluck('student_id');

        $students = Student::select('id','reg_no', 'first_name','middle_name','last_name','date_of_birth',
            'faculty','semester')
            ->whereIn('id', $student_id)
            ->get();


        /*filter student with schedule subject mark ledger*/
        $filteredStudent  = $students->filter(function ($value, $key) use ($exam_schedule_id){
            $subject = $value->markLedger()
                ->select('exam_schedule_id', 'obtain_mark_theory', 'obtain_mark_practical','absent_theory','absent_practical')
                ->whereIn('exam_schedule_id', $exam_schedule_id)
                ->get();

            //filter subject and joint mark from schedules;
            $filteredSubject  = $subject->filter(function ($subject, $key) {
                $joinSub = $subject->examSchedule()
                    ->select('subjects_id','full_mark_theory', 'pass_mark_theory', 'full_mark_practical', 'pass_mark_practical','sorting_order')
                    ->first();

                $subject->subjects_id = $joinSub->subjects_id;
                $subject->sorting_order = $joinSub->sorting_order;
                $subject->full_mark_theory = $joinSub->full_mark_theory;
                $subject->pass_mark_theory = $joinSub->pass_mark_theory;
                $subject->full_mark_practical = $joinSub->full_mark_practical;
                $subject->pass_mark_practical = $joinSub->pass_mark_practical;
                $th = $subject->obtain_mark_theory;
                $pr = $subject->obtain_mark_practical;
                $absent_theory = $subject->absent_theory;
                $absent_practical = $subject->absent_practical;

                /*theory mark comparision*/
                if(isset($subject->pass_mark_theory) && $subject->pass_mark_theory != null){
                    if($absent_theory == 1) {
                        $subject->obtain_mark_theory = "AB";
                    }else{
                        if(!is_numeric($th)){
                            $subject->obtain_mark_theory = "*";
                        }
                    }
                }else{
                    $subject->obtain_mark_theory = "-";
                }

                /*Practical mark comparision*/
                if(isset($subject->pass_mark_practical) && $subject->pass_mark_practical != null){
                    if($absent_practical == 1) {
                        $subject->obtain_mark_practical = "AB";
                    }else{
                        if(!is_numeric($pr)){
                            $subject->obtain_mark_practical = "*";
                        }
                    }
                }else{
                    $subject->obtain_mark_practical= "-";
                }

                /*verify again the new obtain values are number or not*/
                $th_new = $subject->obtain_mark_theory;
                $pr_new = $subject->obtain_mark_practical;

                $subject->total_obtain_mark = (is_numeric($th_new)?$th_new:0) + (is_numeric($pr_new)?$pr_new:0);

                if($th_new >= $subject->pass_mark_theory && $pr_new >= $subject->pass_mark_practical){
                    $subject->remark = '';
                    if($subject->full_mark_theory != null && $th_new > $subject->full_mark_theory){
                        $subject->th_remark = '*N';
                        $subject->remark = '*';
                    }

                    if($subject->full_mark_practica != null && $pr_new > $subject->full_mark_practical){
                        $subject->pr_remark = '*N';
                        $subject->remark = '*';
                    }

                }else{
                    $subject->remark = '*';

                    if($th_new < $subject->pass_mark_theory){
                        $subject->th_remark = '*';
                    }

                    if($pr_new < $subject->pass_mark_practical){
                        $subject->pr_remark = '*';
                    }

                    if($th_new > $subject->full_mark_theory){
                        $subject->th_remark = '*N';
                    }

                    if($pr_new > $subject->full_mark_practical){
                        $subject->pr_remark = '*N';
                    }
                }

                return $subject;
            });

            //$value->subjects = $filteredSubject;
            $value->subjects = $filteredSubject->sortBy('sorting_order');

            /*calculate total mark & percentage*/
            $otm = array_pluck($value->subjects,'obtain_mark_theory');

            $filtered_otm  =  array_where($otm, function ($value, $key) {
                return is_numeric($value);
            });
            $obtainedMarkTh = array_sum($filtered_otm);

            $omp = array_pluck($value->subjects,'obtain_mark_practical');
            $filtered_otp  =  array_where($omp, function ($value, $key) {
                return is_numeric($value);
            });
            $obtainedMarkPr = array_sum($filtered_otp);

            $totalMark = $value->subjects->sum('full_mark_theory') + $value->subjects->sum('full_mark_practical');
            $obtainedMark = $obtainedMarkTh + $obtainedMarkPr;

            $value->total_mark_theory = $obtainedMarkTh;
            $value->total_mark_practical = $obtainedMarkPr;
            $value->total_obtain = $obtainedMark;
            /*caculate percentage*/
            $value->percentage = ($obtainedMark*100)/ $totalMark;

            //$value->rank = "1";
            $remark = $value->subjects->pluck('remark')->toArray();
            $pr_remark = $value->subjects->pluck('pr_remark')->toArray();
            if(in_array('*',$remark) || in_array('*',$pr_remark)){
                $remarkOut = "* Fail";
            }else {
                $remarkOut = "Pass";
            }

            $value->remark = $remarkOut;

            return $value;
        });

        $filteredStudent = $filteredStudent->sortByDesc('percentage');

        //for return ranking
        $rank = 1;
        $filteredPassStudent  = $students->filter(function ($value, $key) use (&$rank){
            if($value->remark == "Pass"){
                $value->rank = $rank;
                $rank++;
                return $value;
            }
        });

        $returnStudentRank = $filteredPassStudent->filter(function ($value, $key) use ($studentId){
            if($value->id == $studentId){
                $rank = $value->rank;
                return $rank;
            }
        });

        return implode(',',array_pluck($returnStudentRank,'rank'));

    }

    public function getStudentPositionInExam($year, $month, $exam, $faculty, $semester,$studentId)
    {
        $year = $year;
        $month = $month;
        $exam = $exam;
        $faculty = $faculty;
        $semester = $semester;
        $studentId = $studentId;

        if($year && $month && $exam && $faculty && $semester) {
            $examScheduleCondition = [
                ['years_id', '=', $year],
                ['months_id', '=', $month],
                ['exams_id', '=', $exam],
                ['faculty_id', '=', $faculty],
                ['semesters_id', '=', $semester]
            ];

            /*Find Exam Schedule Id*/
            $examScheduleId = ExamSchedule::select('id')
                ->where($examScheduleCondition)
                ->get();
            $examScheduleId = array_pluck($examScheduleId, 'id');
            if(count($examScheduleId) > 0){
                $data['ledger_exist'] = ExamMarkLedger::select('exam_mark_ledgers.exam_schedule_id', 'exam_mark_ledgers.students_id',
                    'exam_mark_ledgers.obtain_mark_theory', 'exam_mark_ledgers.obtain_mark_practical', 'exam_mark_ledgers.absent_theory','exam_mark_ledgers.absent_practical',
                    'exam_mark_ledgers.status', 's.id as student_id', 's.reg_no', 's.first_name', 's.middle_name', 's.last_name',
                    's.last_name')
                    ->where('exam_mark_ledgers.exam_schedule_id', $examScheduleId)
                    ->join('students as s', 's.id', '=', 'exam_mark_ledgers.students_id')
                    ->orderBy('exam_mark_ledgers.students_id','asc')
                    ->get();
            }else{

            }

        }

        if($data['ledger_exist']){
            $data['exam_schedule_id'] = implode(',',$examScheduleId);
        }

        $exam_schedule_id = $examScheduleId;
        $student_id = $data['ledger_exist']->pluck('student_id');

        $students = Student::select('id','reg_no', 'first_name','middle_name','last_name','date_of_birth',
            'faculty','semester')
            ->whereIn('id', $student_id)
            ->get();


        /*filter student with schedule subject mark ledger*/
        $filteredStudent  = $students->filter(function ($value, $key) use ($exam_schedule_id){
            $subject = $value->markLedger()
                ->select('exam_schedule_id', 'obtain_mark_theory', 'obtain_mark_practical','absent_theory','absent_practical')
                ->whereIn('exam_schedule_id', $exam_schedule_id)
                ->get();

            //filter subject and joint mark from schedules;
            $filteredSubject  = $subject->filter(function ($subject, $key) {
                $joinSub = $subject->examSchedule()
                    ->select('subjects_id','full_mark_theory', 'pass_mark_theory', 'full_mark_practical', 'pass_mark_practical','sorting_order')
                    ->first();

                $subject->subjects_id = $joinSub->subjects_id;
                $subject->sorting_order = $joinSub->sorting_order;
                $subject->full_mark_theory = $joinSub->full_mark_theory;
                $subject->pass_mark_theory = $joinSub->pass_mark_theory;
                $subject->full_mark_practical = $joinSub->full_mark_practical;
                $subject->pass_mark_practical = $joinSub->pass_mark_practical;
                $th = $subject->obtain_mark_theory;
                $pr = $subject->obtain_mark_practical;
                $absent_theory = $subject->absent_theory;
                $absent_practical = $subject->absent_practical;

                /*theory mark comparision*/
                if(isset($subject->pass_mark_theory) && $subject->pass_mark_theory != null){
                    if($absent_theory == 1) {
                        $subject->obtain_mark_theory = "AB";
                    }else{
                        if(!is_numeric($th)){
                            $subject->obtain_mark_theory = "*";
                        }
                    }
                }else{
                    $subject->obtain_mark_theory = "-";
                }

                /*Practical mark comparision*/
                if(isset($subject->pass_mark_practical) && $subject->pass_mark_practical != null){
                    if($absent_practical == 1) {
                        $subject->obtain_mark_practical = "AB";
                    }else{
                        if(!is_numeric($pr)){
                            $subject->obtain_mark_practical = "*";
                        }
                    }
                }else{
                    $subject->obtain_mark_practical= "-";
                }

                /*verify again the new obtain values are number or not*/
                $th_new = $subject->obtain_mark_theory;
                $pr_new = $subject->obtain_mark_practical;

                $subject->total_obtain_mark = (is_numeric($th_new)?$th_new:0) + (is_numeric($pr_new)?$pr_new:0);

                if($th_new >= $subject->pass_mark_theory && $pr_new >= $subject->pass_mark_practical){
                    $subject->remark = '';
                    if($subject->full_mark_theory != null && $th_new > $subject->full_mark_theory){
                        $subject->th_remark = '*N';
                        $subject->remark = '*';
                    }

                    if($subject->full_mark_practica != null && $pr_new > $subject->full_mark_practical){
                        $subject->pr_remark = '*N';
                        $subject->remark = '*';
                    }

                }else{
                    $subject->remark = '*';

                    if($th_new < $subject->pass_mark_theory){
                        $subject->th_remark = '*';
                    }

                    if($pr_new < $subject->pass_mark_practical){
                        $subject->pr_remark = '*';
                    }

                    if($th_new > $subject->full_mark_theory){
                        $subject->th_remark = '*N';
                    }

                    if($pr_new > $subject->full_mark_practical){
                        $subject->pr_remark = '*N';
                    }
                }

                return $subject;
            });

            //$value->subjects = $filteredSubject;
            $value->subjects = $filteredSubject->sortBy('sorting_order');

            /*calculate total mark & percentage*/
            $otm = array_pluck($value->subjects,'obtain_mark_theory');

            $filtered_otm  =  array_where($otm, function ($value, $key) {
                return is_numeric($value);
            });
            $obtainedMarkTh = array_sum($filtered_otm);

            $omp = array_pluck($value->subjects,'obtain_mark_practical');
            $filtered_otp  =  array_where($omp, function ($value, $key) {
                return is_numeric($value);
            });
            $obtainedMarkPr = array_sum($filtered_otp);

            $totalMark = $value->subjects->sum('full_mark_theory') + $value->subjects->sum('full_mark_practical');
            $obtainedMark = $obtainedMarkTh + $obtainedMarkPr;

            $value->total_mark_theory = $obtainedMarkTh;
            $value->total_mark_practical = $obtainedMarkPr;
            $value->total_obtain = $obtainedMark;
            /*caculate percentage*/
            $value->percentage = ($obtainedMark*100)/ $totalMark;

            //$value->rank = "1";
            $remark = $value->subjects->pluck('remark')->toArray();
            $pr_remark = $value->subjects->pluck('pr_remark')->toArray();
            if(in_array('*',$remark) || in_array('*',$pr_remark)){
                $remarkOut = "* Fail";
            }else {
                $remarkOut = "Pass";
            }

            $value->remark = $remarkOut;

            return $value;
        });

        //$filteredStudent = $filteredStudent->sortByDesc('percentage');
        ////ranking customization keynya user;
        $rank = 0; $score = -1;
        $filteredStudent = $filteredStudent
            ->sortByDesc('total_obtain')->map(function($record) use (&$rank, &$score) {
                if ($score != $record->getAttribute('total_obtain')) {
                    $score = $record->getAttribute('total_obtain');
                    $rank++;
                }

                $record->Position = $rank;
                //$record->setAttribute('Position', $rank);
                //$record->setAttribute('subjects', $record->subjects);
                //return collect($record->getAttributes());
                return $record;
            });

        //$collection = collect($filteredStudent->subjects);
        //$union = $collection->union([3 => ['c'], 1 => ['b']]);
        //$union->all();
        // [1 => ['a'], 2 => ['b'], 3 => ['c']]
        //dd($filteredStudent->toArray());

        //$data['student'] = $filteredStudent;

        //for return ranking
        /*$rank = 1;
        $filteredPassStudent  = $students->filter(function ($value, $key) use ($rank){
            if($value->remark == "Pass"){
                $value->rank = $rank;
                $rank++;
                return $value;
            }
        });*/

        $returnStudentRank = $filteredStudent->filter(function ($value, $key) use ($studentId){
            if($value->id == $studentId){
                $rank = $value->Position;
                return $rank;
            }
        });

        //dd($returnStudentRank);

        return implode(',',array_pluck($returnStudentRank,'Position'));

    }
}