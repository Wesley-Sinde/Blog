<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Attendance;
use App\Models\AttendanceMaster;
use App\Models\Faculty;
use App\Models\FeeHead;
use App\Models\Month;
use App\Models\Year;
use Illuminate\Http\Request;
use URL;
use ViewHelper;
class AttendanceController extends CollegeBaseController
{
    protected $base_route = 'attendance';
    protected $view_path = 'attendance';
    protected $panel = 'Attendance';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];

        if($request->all()) {
            $data['attendance'] = Attendance::select('attendances.id', 'attendances.attendees_type', 'attendances.link_id',
                'attendances.years_id', 'attendances.months_id', 'attendances.day_1', 'attendances.day_2', 'attendances.day_3',
                'attendances.day_4', 'attendances.day_5', 'attendances.day_6', 'attendances.day_7', 'attendances.day_8',
                'attendances.day_9', 'attendances.day_10', 'attendances.day_11', 'attendances.day_12', 'attendances.day_13',
                'attendances.day_14', 'attendances.day_15', 'attendances.day_16', 'attendances.day_17', 'attendances.day_18',
                'attendances.day_19', 'attendances.day_20', 'attendances.day_21', 'attendances.day_22', 'attendances.day_23',
                'attendances.day_24', 'attendances.day_25', 'attendances.day_26', 'attendances.day_27', 'attendances.day_28',
                'attendances.day_29', 'attendances.day_30', 'attendances.day_31', 's.id as students_id', 's.reg_no',
                's.first_name', 's.middle_name', 's.last_name', 's.faculty', 's.semester')
                ->where(function ($query) use ($request) {
                    if ($request->has('year') && $request->get('year') != 0) {
                        $query->where('attendances.years_id', '=', $request->year);
                        $this->filter_query['attendances.years_id'] = $request->year;
                    }

                    if ($request->has('month') && $request->get('month') != 0) {
                        $query->where('attendances.months_id', '=', $request->month);
                        $this->filter_query['attendances.months_id'] = $request->month;
                    }

                    if ($request->has('reg_no') && $request->get('reg_no') != null) {
                        $query->where('s.reg_no', $request->reg_no);
                        $this->filter_query['s.reg_no'] = $request->reg_no;
                    }

                    if ($request->has('faculty')) {
                        $query->where('s.faculty', '=', $request->faculty);
                        $this->filter_query['s.faculty'] = $request->faculty;
                    }

                    if ($request->has('semester_select')) {
                        $query->where('s.semester', '=', $request->semester_select);
                        $this->filter_query['s.semester'] = $request->semester_select;
                    }
                })
                ->join('students as s', 's.id', '=', 'attendances.link_id')
                ->orderBy('attendances.years_id','asc')
                ->orderBy('attendances.months_id','asc')
                ->get();
        }

        $data['year'] = [];
        $data['year'][0] = 'Select Year';
        foreach (Year::select('id', 'title')->get() as $year) {
            $data['year'][$year->id] = $year->title;
        }

        $data['month'] = [];
        $data['month'][0] = 'Select Month';
        foreach (Month::select('id', 'title')->orderBy('id','asc')->get() as $month) {
            $data['month'][$month->id] = $month->title;
        }

        $data['faculties'] = $this->activeFaculties();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function findMonth(Request $request)
    {
        $response = [];
        $response['error'] = true;

        if ($request->has('year_id')) {
            $response['months'] = AttendanceMaster::select('attendance_masters.id','attendance_masters.month', 'm.title')
                ->where('year','=',$request->year_id)
                ->join('months as m','m.id','=','attendance_masters.month')
                ->get();

            if ($response['months']) {
                $response['error'] = false;
            } else
                $response['message'] = 'Invalid request!!';

        } else
            $response['message'] = 'Invalid request!!';

        return response()->json(json_encode($response));
    }

}
