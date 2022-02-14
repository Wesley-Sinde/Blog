<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Assignment;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Assignment\AddValidation;
use App\Http\Requests\Assignment\EditValidation;
use App\Models\Assignment;
use App\Models\AssignmentAnswer;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookStatus;
use App\Models\Faculty;
use App\Models\HomeWork;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use URL;
use ViewHelper;
class AssignmentController extends CollegeBaseController
{
    protected $base_route = 'assignment';
    protected $view_path = 'assignment';
    protected $panel = 'Assignment';
    protected $folder_path;
    protected $filter_query = [];

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.'assignments'.DIRECTORY_SEPARATOR.'questions'.DIRECTORY_SEPARATOR;
    }

    public function index(Request $request)
    {
        $data = [];

        if($request->all()) {
            if(auth()->user()->hasRole('staff')) {
                $id = auth()->user()->id;
                $data['assignment'] = Assignment::select('id', 'created_by', 'last_updated_by', 'years_id', 'semesters_id', 'subjects_id', 'publish_date',
                    'end_date', 'title', 'description', 'file', 'status')
                    ->where('created_by',$id)
                    ->where(function ($query) use ($request) {
                        if ($request->year && $request->year > 0) {
                            $query->where('years_id', '=', $request->year);
                            $this->filter_query['years_id'] = $request->year;
                        }

                        if ($request->semesters_id && $request->semesters_id != "" && $request->semesters_id > 0) {
                            $query->where('semesters_id', '=', $request->semesters_id);
                            $this->filter_query['semesters_id'] = $request->semesters_id;
                        }

                        if ($request->subjects_id && $request->subjects_id != "" && $request->subjects_id > 0) {
                            $query->where('subjects_id', '=', $request->subjects_id);
                            $this->filter_query['subjects_id'] = $request->subjects_id;
                        }

                        if ($request->publish_date_start != "" && $request->publish_date_end != "") {
                            $query->whereBetween('publish_date', [$request->publish_date_start, $request->publish_date_end]);
                            $this->filter_query['publish_date_start'] = $request->publish_date_start;
                            $this->filter_query['publish_date_end'] = $request->publish_date_end;
                        } elseif ($request->publish_date_start != "") {
                            $query->where('publish_date', '>=', $request->publish_date_start);
                            $this->filter_query['publish_date_start'] = $request->publish_date_start;
                        }
                    })
                    ->latest()
                    ->get();
            }else{
                $data['assignment'] = Assignment::select('id', 'created_by', 'last_updated_by', 'years_id', 'semesters_id', 'subjects_id', 'publish_date',
                    'end_date', 'title', 'description', 'file', 'status')
                    ->where(function ($query) use ($request) {
                        if ($request->year && $request->year > 0) {
                            $query->where('years_id', '=', $request->year);
                            $this->filter_query['years_id'] = $request->year;
                        }

                        if ($request->semesters_id && $request->semesters_id != "" && $request->semesters_id > 0) {
                            $query->where('semesters_id', '=', $request->semesters_id);
                            $this->filter_query['semesters_id'] = $request->semesters_id;
                        }

                        if ($request->subjects_id && $request->subjects_id != "" && $request->subjects_id > 0) {
                            $query->where('subjects_id', '=', $request->subjects_id);
                            $this->filter_query['subjects_id'] = $request->subjects_id;
                        }

                        if ($request->publish_date_start != "" && $request->publish_date_end != "") {
                            $query->whereBetween('publish_date', [$request->publish_date_start, $request->publish_date_end]);
                            $this->filter_query['publish_date_start'] = $request->publish_date_start;
                            $this->filter_query['publish_date_end'] = $request->publish_date_end;
                        } elseif ($request->publish_date_start != "") {
                            $query->where('publish_date', '>=', $request->publish_date_start);
                            $this->filter_query['publish_date_start'] = $request->publish_date_start;
                        }
                    })
                    ->latest()
                    ->get();
            }
        }else{
            if(auth()->user()->hasRole('staff')) {
                $id = auth()->user()->id;
                $data['assignment'] = Assignment::select('id', 'created_by', 'last_updated_by', 'years_id', 'semesters_id', 'subjects_id', 'publish_date',
                    'end_date', 'title', 'description', 'file', 'status')
                    ->where('created_by',$id)
                    ->latest()
                    ->limit(50)
                    ->get();
            }else {
                $data['assignment'] = Assignment::select('id', 'created_by', 'last_updated_by', 'years_id', 'semesters_id', 'subjects_id', 'publish_date',
                    'end_date', 'title', 'description', 'file', 'status')
                    ->latest()
                    ->limit(50)
                    ->get();
            }
        }

        $data['faculties'] = $this->activeFaculties();
        $data['years'] = $this->activeYears();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];
        $data['faculties'] = $this->activeFaculties();

        $data['url'] = URL::current();
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $year = Year::where('active_status',1)->first()->id;
        if ($request->hasFile('attach_file')){
            $name = str_slug($request->get('title'));
            $file = $request->file('attach_file');
            $file_name = rand(4585, 9857).'_'.$name.'.'.$file->getClientOriginalExtension();
            $file->move($this->folder_path, $file_name);
        }else{
            $file_name = "";
        }

        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['years_id' => $year]);
        $request->request->add(['file' => $file_name]);

        Assignment::create($request->all());

        $request->session()->flash($this->message_success, $this->panel. ' Add Successfully.');

        if($request->add_assignment_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }
    }

    public function edit(Request $request, $id)
    {
        $id = decrypt($id);
        $data = [];
        $data['row'] = Assignment::find($id);
        if (!$data['row'])
            return parent::invalidRequest();

        if(auth()->user()->hasRole('staff')) {
            $UserId = auth()->user()->id;
            if($data['row']->created_by != $UserId){
                return parent::invalidRequest();
            }
        }

        $data['faculties'] = $this->activeFaculties();

        $data['url'] = URL::current();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {

        if (!$row = Assignment::find($id)) return parent::invalidRequest();

        if ($request->hasFile('attach_file')) {
            $name = str_slug($request->get('title'));
            $file = $request->file('attach_file');
            $file_name = rand(4585, 9857).'_'.$name.'.'.$file->getClientOriginalExtension();
            $file->move($this->folder_path, $file_name);


            if (file_exists($this->folder_path.$row->file))
                @unlink($this->folder_path.$row->file);
        }

        $year = Year::where('active_status',1)->first()->id;

        $request->request->add(['years_id' => $year]);
        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['file' => isset($file_name)?$file_name:$row->file]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect($this->base_route);
    }

    public function view(Request $request, $id)
    {
        $id = decrypt($id);
        $data = [];
        if(auth()->user()->hasRole('staff')) {
            $UserId = auth()->user()->id;
            $data['assignment'] = Assignment::find($id);
            if($data['assignment']->created_by != $UserId){
                return parent::invalidRequest();
            }
        }else{
            $data['assignment'] = Assignment::find($id);
        }

        $data['answers'] = $data['assignment']->answers()->select('assignment_answers.id','assignment_answers.answer_text',
                        'assignment_answers.file','assignment_answers.approve_status','assignment_answers.status',
                        's.reg_no','s.id as students_id','s.first_name',
                        's.middle_name','s.last_name','s.student_image')
                        ->join('students as s','s.id','=','assignment_answers.students_id')
                        ->get();
        return view(parent::loadDataToView($this->view_path.'.detail.index'), compact('data'));
    }

    public function delete(Request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Assignment::find($id)) return parent::invalidRequest();

        if(auth()->user()->hasRole('staff')) {
            $UserId = auth()->user()->id;
            if($row->created_by != $UserId){
                return parent::invalidRequest();
            }
        }

        // remove old file from folder
        if ($row->file && file_exists($this->folder_path.$row->file)) {
            @unlink($this->folder_path.$row->file);
        }

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
                            $row = Assignment::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Assignment::find($row_id);
                            if(auth()->user()->hasRole('staff')) {
                                $UserId = auth()->user()->id;
                                if($row->created_by != $UserId){
                                    return parent::invalidRequest();
                                }
                            }

                            // remove old file from folder
                            if (file_exists($this->folder_path.$row->file))
                                @unlink($this->folder_path.$row->file);

                            $row->delete();
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, $request->get('bulk_action'). ' Action Successfully.');
                else
                    $request->session()->flash($this->message_success, ' Deleted successfully.');

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }

    public function active(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Assignment::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Assignment::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }


    public function findSubject(Request $request)
    {
        $semester = Semester::where('id',$request->get('semester_id'))->first();

        if(auth()->user()->hasRole('staff')){
            $id = auth()->user()->hook_id;

            /*Find Teacher/Staff Accessible Subject*/
            $collectSubject = $semester->subjects()->select('subjects.id as subject_id','subjects.title as subject_title')
                ->where('subjects.staff_id',$id)
                ->get();
            $subjects = array_pluck($collectSubject,'subject_title','subject_id');
        }else{
            /*Find Subject Title with associated Ids*/
            $collectSubject = $semester->subjects()->select('subjects.id as subject_id','subjects.title as subject_title')->get();
            $subjects = array_pluck($collectSubject,'subject_title','subject_id');
        }


        if ($subjects) {
            $response['subjects'] = $subjects;
            $response['success'] = 'Subjects Found, Select Subject and Manage Question.';
        }else {
            $response['error'] = 'No Any Subject Found. Please Contact Your Administrator.';
        }

        return response()->json(json_encode($response));
    }


    /*answer*/
    public function viewAnswer(Request $request, $id, $answer)
    {
        $data = [];
        $data['assignment'] = Assignment::find($id);

        if(auth()->user()->hasRole('staff')) {
            $UserId = auth()->user()->id;
            if($data['assignment']->created_by != $UserId){
                return parent::invalidRequest();
            }
        }

        $data['answers'] = $data['assignment']->answers()->where('assignment_answers.id',$answer)
            ->select('assignment_answers.created_by','assignment_answers.last_updated_by','assignment_answers.id','assignment_answers.answer_text',
            'assignment_answers.file','assignment_answers.approve_status','assignment_answers.status','s.id as students_id')
            ->join('students as s','s.id','=','assignment_answers.students_id')
            ->first();

        if(!$data['answers']) return back()->with('message_warning','No Any Answer Submitted');

        $data['student'] = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
            'students.faculty','students.semester', 'students.academic_status', 'students.first_name', 'students.middle_name',
            'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group', 'students.nationality',
            'students.mother_tongue', 'students.email', 'students.extra_info', 'students.student_image', 'students.status')
            ->where('students.id','=',$data['answers']->students_id)
            ->first();

        return view(parent::loadDataToView($this->view_path.'.answer.index'), compact('data'));
    }

    public function approveAnswer(request $request, $id)
    {
        if (!$row = AssignmentAnswer::find($id)) return parent::invalidRequest();

        $request->request->add(['approve_status' => 1]);

        $row->update($request->all());

        $request->session()->flash($this->message_success,'Assignment Answer Approve Successfully.');
        return back();
    }

    public function rejectAnswer(request $request, $id)
    {
        if (!$row = AssignmentAnswer::find($id)) return parent::invalidRequest();

        $request->request->add(['approve_status' => 2]);

        $row->update($request->all());

        $request->session()->flash($this->message_success,'Assignment Answer Rejected Successfully.');
        return back();
    }

    public function deleteAnswer(Request $request, $id)
    {
        if (!$row = AssignmentAnswer::find($id)) return parent::invalidRequest();

        $folder_path = public_path().DIRECTORY_SEPARATOR.'assignments'.DIRECTORY_SEPARATOR.'answers'.DIRECTORY_SEPARATOR;
        // remove old file from folder
        if ($row->file && file_exists($folder_path.$row->file)) {
            @unlink($folder_path.$row->file);
        }

        $row->delete();
        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkActionAnswer(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['Approve', 'Reject', 'Delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    switch ($request->get('bulk_action')) {
                        case 'Approve':
                            $row = AssignmentAnswer::find($row_id);
                            if ($row) {
                                $row->approve_status = 1;
                                $row->save();
                            }
                            break;
                        case 'Reject':
                            $row = AssignmentAnswer::find($row_id);
                            if ($row) {
                                $row->approve_status = 2;
                                $row->save();
                            }
                            break;
                        case 'Delete':
                            $row = AssignmentAnswer::find($row_id);
                            // remove old file from folder
                            if($row) {
                                $folder_path = public_path().DIRECTORY_SEPARATOR.'assignments'.DIRECTORY_SEPARATOR.'answers'.DIRECTORY_SEPARATOR;
                                if (file_exists($folder_path . $row->file))
                                    @unlink($folder_path . $row->file);

                                $row->delete();
                            }
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'Approve')
                    $request->session()->flash($this->message_success, ' Answers Approve Successfully.');
                elseif ($request->get('bulk_action') == 'Reject' )
                    $request->session()->flash($this->message_success, 'Answers Rejected Successfully.');
                else
                    $request->session()->flash($this->message_success, 'Answers Deleted successfully.');

                return back();

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return back();
            }

        } else return parent::invalidRequest();

    }

}
