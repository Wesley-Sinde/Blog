<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\PrintOut;

use App\Http\Controllers\CollegeBaseController;
use App\Models\ExamSchedule;
use App\Models\Semester;
use App\Models\Student;
use App\Traits\ExaminationScope;
use Illuminate\Http\Request;
use view, URL;
use ViewHelper;
class ExamPrintController extends CollegeBaseController
{

    use ExaminationScope;

    protected $base_route = 'print.exam';
    protected $view_path = 'print.exam';
    protected $panel = 'Examination Printing';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function admitCard(Request $request)
    {
        $data = [];
        $data['year'] = $request->get('years_id');
        $data['month'] = $request->get('months_id');
        $data['exam'] = $request->get('exams_id');
        $data['faculty'] = $request->get('target_faculty');
        $data['semester'] = $request->get('semester_select');
        $whereCondition = [
            ['years_id' , '=' , $request->get('years_id')],
            ['months_id' , '=' , $request->get('months_id')],
            ['exams_id', '=' , $request->get('exams_id')],
            ['faculty_id', '=' , $request->get('target_faculty')],
            ['semesters_id', '=' , $request->get('semester_select')]
        ];
        $data['subjects'] = ExamSchedule::select('exam_schedules.subjects_id',
            'exam_schedules.date', 'exam_schedules.start_time', 'exam_schedules.end_time',
            'exam_schedules.full_mark_theory', 'exam_schedules.pass_mark_theory',
            'exam_schedules.full_mark_practical',
            'exam_schedules.pass_mark_practical', 's.code', 's.title')
            ->where($whereCondition)
            ->join('subjects as s','s.id','=','exam_schedules.subjects_id')
            ->orderBy('sorting_order','asc')
            ->get();

        if($data['subjects']->count() == 0)
            return back()->with($this->message_warning, 'No any Subject Scheduled in your target exam. Please, Schedule exam first. ');

        $data['student'] = Student::select('id','reg_no','date_of_birth', 'first_name', 'middle_name', 'last_name','student_image','gender','blood_group' /*,'faculty', 'semester','status'*/)
            ->whereIn('id',$request->get('chkIds'))
            ->get();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        if($request->print_type == 1){
            return view(parent::loadDataToView($this->view_path.'.admit-card'), compact('data'));
        }else{
            return view(parent::loadDataToView($this->view_path.'.admit-card-with-schedule'), compact('data'));
        }

    }

    public function examRoutine(Request $request)
    {

        $data['general_setting'] = $this->getGeneralSetting();
        if(isset($data['general_setting']) && $data['general_setting'] != null){
        }else{
            request()->session()->flash($this->message_warning, 'Please, Setup your institution detail or contact your system administrator');
            return redirect()->route('home');
        }

        $data = [];
        $data['year'] = $request->get('years_id');
        $data['month'] = $request->get('months_id');
        $data['exam'] = $request->get('exams_id');
        $data['faculty'] = $request->get('target_faculty');
        $data['semester'] = $request->get('semester_select');

        $whereCondition = [
            ['years_id' , '=' , $request->get('years_id')],
            ['months_id' , '=' , $request->get('months_id')],
            ['exams_id', '=' , $request->get('exams_id')],
            ['faculty_id', '=' , $request->get('target_faculty')],
            ['semesters_id', '=' , $request->get('semester_select')]
        ];

        $data['subjects'] = ExamSchedule::select('exam_schedules.subjects_id',
            'exam_schedules.date', 'exam_schedules.start_time', 'exam_schedules.end_time',
            'exam_schedules.full_mark_theory', 'exam_schedules.pass_mark_theory',
            'exam_schedules.full_mark_practical',
            'exam_schedules.pass_mark_practical', 's.code', 's.title')
            ->where($whereCondition)
            ->join('subjects as s','s.id','=','exam_schedules.subjects_id')
            ->orderBy('sorting_order','asc')
            ->get();

        if($data['subjects']->count() == 0)
            return back()->with($this->message_warning, 'No any Subject Scheduled in your target exam. Please, Schedule exam first. ');

        return view(parent::loadDataToView($this->view_path.'.routine'), compact('data'));
    }

    public function examMarkSheet(Request $request)
    {
        if($request->has('result-type')){
            if($request->get('result-type')=='grading'){
                $data = $this->gradingSystem($request);
                return view(parent::loadDataToView($this->view_path.'.grading-sheet'), compact('data'));
            }elseif($request->get('result-type') =='percentage'){
                $data = $this->percentageSystem($request);
                return view(parent::loadDataToView($this->view_path.'.mark-sheet'), compact('data'));
            }elseif($request->get('result-type') =='ledger'){
                $data = $this->examMarkLedger($request);
                return view(parent::loadDataToView($this->view_path.'.mark-ledger'), compact('data'));
            }else{
                return back();
            }
        }else{
            return back();
        }



    }

    public function percentageSystem(Request $request)
    {
        if ($request->has('chkIds')) {
            $exam_schedule_id = explode(',',$request->get('exam_schedule_id'));
            $student_id = $request->get('chkIds');

            $students = Student::select('id','reg_no', 'first_name','middle_name','last_name','date_of_birth',
                'faculty','semester')
                ->whereIn('id', $student_id)
                ->get();

            /*filter student with schedule subject markledger*/
            $filteredStudent  = $students->filter(function ($value, $key) use ($exam_schedule_id){
                $subject = $value->markLedger()
                    ->select( 'exam_schedule_id',  'obtain_mark_theory', 'obtain_mark_practical','absent_theory','absent_practical')
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
                            //dd($th);//35
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

                return $value;
            });

            //$filteredStudent = $filteredStudent->sortByDesc('percentage');
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

            $data['student'] = $filteredStudent;

        } else {
            $request->session()->flash($this->message_warning, 'Please, Check at least one Students row.');
            return back();
        }

        $data['exam'] = $request->get('exams_id');
        $data['year'] = $request->get('year_id');
        $data['month'] = $request->get('month_id');
        $data['faculty'] = $request->get('faculty_id');
        $data['semester'] = $request->get('semester_id');

        return $data;
    }

    public function gradingSystem(Request $request)
    {
        if ($request->has('chkIds')) {
            $exam_schedule_id = explode(',',$request->get('exam_schedule_id'));
            $student_id = $request->get('chkIds');

            $data['semester'] = $semester = Semester::find($request->get('semester_id'));

            $students = Student::select('id','reg_no', 'first_name','middle_name','last_name','date_of_birth',
                'faculty','semester')
                ->whereIn('id', $student_id)
                ->get();

            /*filter student with schedule subject mark ledger*/
            $filteredStudent  = $students->filter(function ($value, $key) use ($exam_schedule_id, $semester){
                $subject = $value->markLedger()
                    ->select( 'exam_schedule_id',  'obtain_mark_theory', 'obtain_mark_practical','absent_theory','absent_practical')
                    ->whereIn('exam_schedule_id', $exam_schedule_id)
                    ->get();

                //filter subject and joint mark from schedules;
                $filteredSubject  = $subject->filter(function ($subject, $key) use($semester){
                    $joinSub = $subject->examSchedule()
                        ->select('subjects_id','full_mark_theory', 'pass_mark_theory', 'full_mark_practical', 'pass_mark_practical','sorting_order')
                        ->first();

                    if(!$joinSub) return back();

                    $subject->subjects_id = $joinSub->subjects_id;


                    $subject->sorting_order = $joinSub->sorting_order;
                    $subject->full_mark_theory =$full_mark_theory = $joinSub->full_mark_theory;
                    $subject->pass_mark_theory = $pass_mark_theory = $joinSub->pass_mark_theory;
                    $subject->full_mark_practical = $full_mark_practical = $joinSub->full_mark_practical;
                    $subject->pass_mark_practical = $pass_mark_practical = $joinSub->pass_mark_practical;
                    $obtain_mark_theory = $subject->obtain_mark_theory;
                    $absent_theory = $subject->absent_theory;
                    $obtain_mark_practical = $subject->obtain_mark_practical;
                    $absent_practical = $subject->absent_practical;

                    /*th absent*/
                    if($absent_theory != 1) {
                        if ($full_mark_theory > 0) {
                            $th_per = ($obtain_mark_theory * 100) / $full_mark_theory;
                            $subject->obtain_score_theory = $th_per ==0?'*NG':$this->getGrade($semester, $th_per);
                        }
                    }else{
                        $subject->obtain_score_theory = "*AB";
                    }

                    /*pr absent*/
                    if($absent_practical != 1) {
                        if($full_mark_practical > 0) {
                            $pr_per = ($obtain_mark_practical * 100) / $full_mark_practical;
                            $subject->obtain_score_practical = $pr_per ==0?"*NG":$this->getGrade($semester, $pr_per);
                        }
                    }else{
                        $pr_per = 0;
                        $subject->obtain_score_practical = "*AB";
                    }

                    /*check absent on theory & practical*/
                    $absentBoth = false;
                    if($absent_theory == 1 && $absent_practical == 1){
                        $absentBoth = true;
                    }

                    //Final Grade
                    $subject->totalMark = $totalMark = $full_mark_theory + $full_mark_practical;
                    $subject->obtainedMark = $obtainedMark = $obtain_mark_theory + $obtain_mark_practical;
                    $subject->percentage = $percentage = ($obtainedMark*100)/ $totalMark;

                    //verify both th & pr absent
                        if($absentBoth == false) {
                            $subject->final_grade = $this->getGrade($semester, $percentage);
                            $subject->grade_point = number_format((float)$this->getPoint($semester, $percentage),2);
                            $subject->remark = $this->getRemark($semester, $percentage);
                        }else{
                            $subject->final_grade = "*MG";
                            $subject->grade_point = "*MP";
                            $subject->remark = "-";
                        }

                    return $subject;
                });

                //order subject order on schedule
                $value->subjects = $filteredSubject->sortBy('sorting_order');

                /*calculate GPA*/
                /*calculate total mark & percentage*/
                $gp_collection = array_pluck($value->subjects,'grade_point');

                $filtered_gp_collection  =  array_where($gp_collection, function ($value, $key) {
                    return is_numeric($value);
                });

                /*calculate total mark & percentage*/
                $otm = array_pluck($value->subjects,'obtain_mark_theory');
                //dd($otm);

                $filtered_otm  =  array_where($otm, function ($value, $key) {
                    return is_numeric($value);
                });

                $obtainedMarkTh = array_sum($filtered_otm);

                $omp = array_pluck($value->subjects,'obtain_mark_practical');
                $filtered_otp  =  array_where($omp, function ($value, $key) {
                    return is_numeric($value);
                });
                $obtainedMarkPr = array_sum($filtered_otp);

                $totalMark = $value->subjects->sum('totalMark');
                //dd($totalMark);
                $obtainedMark = $value->subjects->sum('obtainedMark');
                //$obtainedMark = $obtainedMarkTh + $obtainedMarkPr;


                $value->total_mark_theory = $obtainedMarkTh;
                $value->total_mark_practical = $obtainedMarkPr;
                $value->total_obtain = $obtainedMark;
                /*Calculate percentage*/
                //dd($obtainedMark.'-'.$totalMark);
                $value->percentage = $percentage = ($obtainedMark*100)/ $totalMark;
                $value->gpa_grade = $this->getGrade($semester, $value->percentage);
                $value->gpa_average = $this->getPoint($semester, $value->percentage);
                $value->remark = $this->getRemark($semester, $value->percentage);

                return $value;

            });

            $data['student'] = $filteredStudent;

        } else {
            $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
            return back();
        }

        $data['exam'] = $request->get('exams_id');
        $data['year'] = $request->get('year_id');
        $data['faculty'] = $request->get('faculty_id');
        $data['semester'] = $request->get('semester_id');

        return $data ;
    }

    public function examMarkLedger(Request $request)
    {

        if ($request->has('chkIds')) {
            $exam_schedule_id = explode(',', $request->get('exam_schedule_id'));
            $student_id = $request->get('chkIds');
            $semester = Semester::find($request->get('semester_id'));


            $students = Student::select('id','reg_no', 'first_name','middle_name','last_name','date_of_birth',
                'faculty','semester')
                ->whereIn('id', $student_id)
                ->get();

            /*filter student with schedule subject mark ledger*/
            $filteredStudent  = $students->filter(function ($value, $key) use ($semester, $exam_schedule_id){
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

                /*calculate grading Score*/
                //verify both th & pr absent
                if($value->percentage > 0) {
                    $value->final_grade = $this->getGrade($semester, $value->percentage);
                    $value->grade_point = $this->getPoint($semester, $value->percentage);
                    $value->remark = $this->getRemark($semester, $value->percentage);
                }else{
                    $value->final_grade = "*MG";
                    $value->grade_point = "*MP";
                    $value->remark = "-";
                }

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

            $data['student'] = $filteredStudent;

        } else {
            $request->session()->flash($this->message_warning, 'Please, Check at least one Students row.');
            return back();
        }

        $data['exam'] = $request->get('exams_id');
        $data['year'] = $request->get('year_id');
        $data['month'] = $request->get('month_id');
        $data['faculty'] = $request->get('faculty_id');
        $data['semester'] = $request->get('semester_id');
        return $data;
    }
}

