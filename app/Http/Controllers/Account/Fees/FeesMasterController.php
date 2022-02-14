<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Account\Fees;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Faculty;
use App\Models\FeeHead;
use App\Models\FeeMaster;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use URL;
use ViewHelper;
class FeesMasterController extends CollegeBaseController
{
    protected $base_route = 'account.fees.master';
    protected $view_path = 'account.fees.master';
    protected $panel = 'Fees Master';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        if($request->all()) {
            $data['fee_master'] = FeeMaster::select('fee_masters.id', 'fee_masters.students_id', 'fee_masters.semester',
                'fee_masters.fee_head', 'fee_masters.fee_due_date', 'fee_masters.fee_amount', 'fee_masters.status',
                'students.reg_no', 'students.reg_date', 'students.first_name', 'students.middle_name', 'students.last_name', 'students.semester')
                ->where(function ($query) use ($request) {

                    $this->commonStudentFilterCondition($query, $request);

                    if ($request->has('fee_due_date_start') && $request->has('fee_due_date_end')) {
                        $query->whereBetween('fee_masters.fee_due_date', [$request->get('fee_due_date_start'), $request->get('fee_due_date_end')]);
                        $this->filter_query['fee_due_date_start'] = $request->get('fee_due_date_start');
                        $this->filter_query['fee_due_date_end'] = $request->get('fee_due_date_end');
                    } elseif ($request->has('fee_due_date_start')) {
                        $query->where('fee_masters.fee_due_date', '>=', $request->get('fee_due_date_start'));
                        $this->filter_query['fee_due_date_start'] = $request->get('fee_due_date_start');
                    } elseif ($request->has('fee_due_date_end')) {
                        $query->where('fee_masters.fee_due_date', '<=', $request->get('fee_due_date_end'));
                        $this->filter_query['fee_due_date_end'] = $request->get('fee_due_date_end');
                    }

                    if ($request->has('fee_heads') && $request->get('fee_heads') > 0) {
                        $query->where('fee_masters.fee_head', '=', $request->fee_heads);
                        $this->filter_query['fee_head'] = $request->fee_heads;
                    }

                    if ($request->has('amount_start') && $request->has('amount_end')) {
                        $query->whereBetween('fee_masters.fee_amount', [$request->get('amount_start'), $request->get('amount_end')]);
                        $this->filter_query['amount_start'] = $request->get('amount_start');
                        $this->filter_query['amount_end'] = $request->get('amount_end');
                    } elseif ($request->has('amount_start')) {
                        $query->where('fee_masters.fee_amount', '>=', $request->get('amount_start'));
                        $this->filter_query['amount_start'] = $request->get('amount_start');
                    } elseif ($request->has('amount_end')) {
                        $query->where('fee_masters.fee_amount', '<=', $request->get('amount_end'));
                        $this->filter_query['amount_end'] = $request->get('amount_end');
                    }
                })
                ->orderBy('fee_masters.fee_due_date', 'desc')
                ->join('students', 'students.id', '=', 'fee_masters.students_id')
                ->get();
        }else{
            $year = $this->getActiveYear();
            $data['fee_master'] = FeeMaster::select('fee_masters.id', 'fee_masters.students_id', 'fee_masters.semester',
                'fee_masters.fee_head', 'fee_masters.fee_due_date', 'fee_masters.fee_amount', 'fee_masters.status',
                'students.reg_no', 'students.reg_date', 'students.first_name', 'students.middle_name', 'students.last_name', 'students.semester')
                ->whereYear('fee_masters.fee_due_date', '=', $year)
                ->orderBy('fee_masters.fee_due_date', 'desc')
                ->join('students', 'students.id', '=', 'fee_masters.students_id')
                ->get();
        }

        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();
        $data['fee_heads'] = $this->activeFeeHead();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];
        if($request->all()) {
            if ($request->has('facility')) {
                /*with library facility*/
                if ($request->get('facility') == 1) {
                    $data['student'] = Student::select('students.id', 'students.reg_no', 'students.reg_date', 'students.first_name',
                        'students.middle_name', 'students.last_name', 'students.faculty', 'students.semester', 'students.academic_status', 'students.status')
                        ->where(function ($query) use ($request) {
                            $this->commonStudentFilterCondition($query, $request);
                        })
                        ->where('l.user_type','=',1)
                        ->join('library_members as l', 'l.member_id', '=', 'students.id')
                        ->get();
                }

                /*with Hostel facility*/
                if ($request->get('facility') == 2) {
                    $data['student'] = Student::select('students.id', 'students.reg_no', 'students.reg_date', 'students.first_name',
                        'students.middle_name', 'students.last_name', 'students.faculty', 'students.semester', 'students.academic_status', 'students.status')
                        ->where(function ($query) use ($request) {
                            $this->commonStudentFilterCondition($query, $request);
                        })
                        ->where('r.user_type',1)
                        ->join('residents as r', 'r.member_id', '=', 'students.id')
                        ->get();
                }

                /*with transport facility*/
                if ($request->get('facility') == 3) {
                    $data['student'] = Student::select('students.id', 'students.reg_no', 'students.reg_date', 'students.first_name',
                        'students.middle_name', 'students.last_name', 'students.faculty', 'students.semester', 'students.academic_status', 'students.status')
                        ->where(function ($query) use ($request) {
                            $this->commonStudentFilterCondition($query, $request);
                        })
                        ->where('tu.user_type',1)
                        ->join('transport_users as tu', 'tu.member_id', '=', 'students.id')
                        ->get();
                }

            } else {
                $data['student'] = Student::select('students.id', 'students.reg_no', 'students.reg_date', 'students.first_name',
                    'students.middle_name', 'students.last_name', 'students.faculty', 'students.semester', 'students.academic_status', 'students.status')
                    ->where(function ($query) use ($request) {
                        $this->commonStudentFilterCondition($query, $request);
                    })
                    ->get();
            }
        }

        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();
        $data['fee_heads'] = $this->activeFeeHead();

        $data['facility'] = ['0'=>'Select Facility','1'=>'Library','2'=>'Hostel','3'=>'Transport'];

        $feeHeadAll = FeeHead::Active()->orderby('fee_head_title')->get();
        $data['feeHead'] = $feeHeadAll->pluck('fee_head_title','id');

        $data['randId'] = $randomId = rand(999,1);
        //Create an array of option attribute
        $data['fee_head_attributes']  =  $feeHeadAll->mapWithKeys(function ($feeHead) use($randomId) {
            return [$feeHead->id => ['data-feeHead-amount' => $feeHead->fee_head_amount, 'data-rand-id' => $randomId]];
        })->all();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(Request $request)
    {
        if ($request->has('chkIds')) {
            foreach ($request->get('chkIds') as $row_id) {
                $row = Student::find($row_id);
                if ($row && $request->has('fee_head')) {
                    foreach ($request->get('fee_head') as $key => $fee_head) {
                        $date = Carbon::parse($request->get('fee_due_date')[$key])->format('Y-m-d');
                        FeeMaster::create([
                            'students_id' => $row->id,
                            'semester' => $row->semester,
                            'fee_head' => $request->get('fee_head')[$key],
                            'fee_due_date' => $date,
                            'fee_amount' => $request->get('fee_amount')[$key],
                            'created_by' => auth()->user()->id,
                        ]);
                    }
                }else {
                    $request->session()->flash($this->message_warning, 'Please, Add Fee Master at least one row.');
                    return redirect()->route($this->base_route);
                }
            }
        }else {
            $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
            return redirect()->route($this->base_route);
        }

        $request->session()->flash($this->message_success, $this->panel. ' Add Successfully.');
        return back();

    }

    public function edit(Request $request, $id)
    {
        $data = [];
        $data['row'] = FeeMaster::select('id', 'students_id', 'semester', 'fee_head','fee_due_date','fee_amount','status')
            ->where('id','=',$id)
            ->first();
        if (!$data['row'])
            return parent::invalidRequest();

        $data['row']->reg_no = parent::getStudentById($data['row']->students_id) ;
        $data['row']->student_name = parent::getStudentNameById($data['row']->students_id) ;
        $data['row']->semester = parent::getSemesterById($data['row']->semester) ;
        $data['row']->fee_head = parent::getFeeHeadById($data['row']->fee_head) ;

        $data['faculties'] = $this->activeFaculties();

        $data['url'] = URL::current();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function update(Request $request, $id)
    {

        if (!$row = FeeMaster::find($id)) return parent::invalidRequest();
        $row->update([
            'fee_due_date' => $request->get('fee_due_date'),
            'fee_amount' => $request->get('fee_amount'),
            'last_updated_by' => auth()->user()->id,
        ]);
        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = FeeMaster::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->back();
    }

    public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    switch ($request->get('bulk_action')) {
                        case 'active':
                        case 'in-active':
                            $row = FeeMaster::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = FeeMaster::find($row_id);
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
        if (!$row = FeeHead::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = FeeHead::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function feeHtmlRow()
    {
        //get all head
        $feeHeadAll = FeeHead::Active()->orderby('fee_head_title')->get();
        $feeHead = $feeHeadAll->pluck('fee_head_title','id');
        //$feeHead = array_prepend($feeHead,'Select Fee Head','id');
        $randomId = rand(999,1);
        //Create an array of option attribute
        $fee_head_attributes =  $feeHeadAll->mapWithKeys(function ($feeHead) use($randomId) {
                return [$feeHead->id => ['data-feeHead-amount' => $feeHead->fee_head_amount, 'data-rand-id' => $randomId]];
            })->all();

        $response['html'] = view($this->view_path.'.includes.fee_tr', ['fee_heads' => $feeHead, "fee_head_attributes" => $fee_head_attributes, 'randId' => $randomId])->render();
        return response()->json(json_encode($response));
    }




}
