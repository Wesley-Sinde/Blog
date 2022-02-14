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
use App\Models\AttendanceMaster;
use App\Models\Month;
use App\Models\Year;
use Illuminate\Http\Request;
use URL;
use ViewHelper;
class AttendanceMasterController extends CollegeBaseController
{
    protected $base_route = 'attendance.master';
    protected $view_path = 'attendance.master';
    protected $panel = 'Monthly Calendar';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['attendance_master'] = AttendanceMaster::select('id', 'year', 'month', 'day_in_month','holiday','open','status')
            ->where(function ($query) use ($request) {

                if ($request->has('year')) {
                    $query->where('year', '=', $request->year);
                    $this->filter_query['year'] = $request->year;
                }

                if ($request->has('month')) {
                    $query->where('month', '=', $request->month);
                    $this->filter_query['month'] = $request->month;
                }

            })
            ->orderBy('year','desc')
            ->orderBy('month', 'asc')
            ->get();


        $data['year'] = [];
        $data['year'][0] = 'Select Year';
        foreach (Year::select('id', 'title')->orderBy('id','asc')->get() as $year) {
            $data['year'][$year->id] = $year->title;
        }


        $data['month'] = [];
        $data['month'][0] = 'Select Month';
        foreach (Month::select('id', 'title')->orderBy('id','asc')->get() as $month) {
            $data['month'][$month->id] = $month->title;
        }


        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;


        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add()
    {
        $data = [];

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        $data['year'] = [];
        $data['year'][0] = 'Select Year';
        foreach (Year::select('id', 'title')->get() as $year) {
            $data['year'][$year->id] = $year->title;
        }

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(Request $request)
    {
        if($request->get('year') > 0 ){
            if ($request->has('month')) {
                foreach ($request->get('month') as $key => $month) {
                    $allow = AttendanceMaster::where('year','=',$request->get('year'))
                        ->where('month','=',$request->get('month')[$key])
                        ->first();
                    if(!$allow){
                        $ledger = AttendanceMaster::create([
                            'year' =>$request->get('year'),
                            'month' => $request->get('month')[$key],
                            'day_in_month' => $request->get('day_in_month')[$key],
                            'holiday' => $request->get('holiday')[$key],
                            'open' => $request->get('open')[$key],
                            'created_by' => auth()->user()->id,
                        ]);

                        $request->session()->flash($this->message_success, $this->getYearById($ledger->year).'-'
                            .$this->getMonthById($ledger->month).' Add on '.$this->panel.' Successfully.');
                    }else{
                        $request->session()->flash($this->message_warning, $this->getYearById($allow->year).'-'
                            .$this->getMonthById($allow->month). ' Already Exist on Attendence Ledger. Please Find & Edit');
                    }
                }
            }else {
                $request->session()->flash($this->message_warning, 'Please, Add at least one Month with Details.');
            }
        }else{
            $request->session()->flash($this->message_warning, 'You have no any year for add Ledger.Please, Choose Year First.');
        }

        return redirect()->route($this->base_route);
    }

    public function edit(Request $request, $id)
    {
        $data = [];
        $data['row'] = AttendanceMaster::select('attendance_masters.id', 'attendance_masters.year', 'attendance_masters.month',
            'attendance_masters.day_in_month','attendance_masters.holiday','attendance_masters.open',
            'attendance_masters.status','y.title as year_title', 'm.title as month_title')
            ->where('attendance_masters.id','=',$id)
            ->join('years as y','y.id','=','attendance_masters.year')
            ->join('months as m','m.id','=','attendance_masters.month')
            ->first();

        if (!$data['row'])
            return parent::invalidRequest();

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function update(Request $request, $id)
    {
        if (!$row = AttendanceMaster::find($id)) return parent::invalidRequest();

        $row->update([
            'day_in_month' => $request->get('day_in_month'),
            'holiday' => $request->get('holiday'),
            'open' => $request->get('open'),
            'last_updated_by' => auth()->user()->id,
        ]);
        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = AttendanceMaster::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    switch ($request->get('bulk_action')) {
                        case 'active':
                        case 'in-active':
                            $row = AttendanceMaster::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = AttendanceMaster::find($row_id);
                            $row->delete();
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, $request->get('bulk_action'). ' Action Successfully.');
                else
                    $request->session()->flash($this->message_success, 'Deleted successfully.');

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }

    public function active(request $request, $id)
    {
        if (!$row = AttendanceMaster::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = AttendanceMaster::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function monthHtmlRow()
    {
        $months = [];
        foreach (Month::select('id', 'title')->Active()->get() as $month) {
            $months[$month->id] = $month->title;

        }
        $response['html'] = view($this->view_path.'.includes.month_tr', [ 'months' => $months ])->render();
        return response()->json(json_encode($response));

    }

}
