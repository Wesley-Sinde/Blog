<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Academic\Subject\AddValidation;
use App\Http\Requests\Academic\Subject\EditValidation;
use App\Models\Staff;
use App\Models\Subject;
use Illuminate\Http\Request;
class SubjectController extends CollegeBaseController
{
    protected $base_route = 'subject';
    protected $view_path = 'academic.subject';
    protected $panel = 'Course';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index()
    {
       $data = [];
       $data['subject'] = Subject::select('id', 'title', 'code', 'full_mark_theory', 'pass_mark_theory',
           'full_mark_practical', 'pass_mark_practical', 'credit_hour', 'sub_type', 'class_type', 'staff_id',
           'description','status')
            ->orderBy('title')
            ->get();

        $data['staffs'] = [];
        $data['staffs'][] = 'Select Teacher';
        foreach (Staff::select('id','first_name','middle_name','last_name')->Active()->get() as $staff) {
            $data['staffs'][$staff->id] = $staff->first_name.' '.$staff->middle_name.' '.$staff->last_name ;
        }

       return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);
        $subject = Subject::create($request->all());

        $request->session()->flash($this->message_success, $this->panel. 'Created Successfully.');
        return redirect()->route($this->base_route);
    }

    public function edit($id)
    {

        $data = [];
        if (!$data['row'] = Subject::find($id))
            return parent::invalidRequest();

        $data['subject'] = Subject::select('id', 'title', 'code', 'full_mark_theory', 'pass_mark_theory',
            'full_mark_practical', 'pass_mark_practical', 'credit_hour', 'sub_type', 'class_type', 'staff_id',
            'description','status')
            ->orderBy('title')
            ->get();

        $data['staffs'] = [];
        $data['staffs'][] = 'Select Teacher';
        foreach (Staff::select('id','first_name','middle_name','last_name')->Active()->get() as $staff) {
            $data['staffs'][$staff->id] = $staff->first_name.' '.$staff->middle_name.' '.$staff->last_name ;
        }


        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        if (!$row = Subject::find($id)) return parent::invalidRequest();
        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $subject = $row->update($request->all());
        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Subject::find($id)) return parent::invalidRequest();

        $row->delete();
        $row->semester()->detach();

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
                            $row = Subject::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Subject::find($row_id);
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
        if (!$row = Subject::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = Subject::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function subjectNameAutocomplete(Request $request)
    {
        if ($request->has('q')) {

            $subjects = Subject::select('id', 'title', 'code', 'status')
                ->where('title', 'like', '%'.$request->get('q').'%')
                ->get();

            $response = [];
            foreach ($subjects as $subject) {
                $response[] = ['id' => $subject->id, 'text' => $subject->code.' - '.$subject->title];
            }

            return json_encode($response);
        }

        abort(501);
    }

}
