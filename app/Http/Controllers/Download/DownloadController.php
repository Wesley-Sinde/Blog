<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Download;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Download\AddValidation;
use App\Http\Requests\Download\EditValidation;
use App\Models\Download;
use App\Models\Semester;
use Illuminate\Http\Request;
use ViewHelper;
use view, URL;

class DownloadController extends CollegeBaseController
{
    protected $base_route = 'download';
    protected $view_path = 'download';
    protected $panel = 'Download';
    protected $folder_path;
    protected $folder_name = 'downloads';
    protected $filter_query = [];

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR;

    }

    public function index(Request $request)
    {
        $data = [];
        $data['download'] = Download::get();

        if($request->all()) {
            if(auth()->user()->hasRole('staff')) {
                $id = auth()->user()->id;
                $data['download'] = Download::where('created_by',$id)
                    ->where(function ($query) use ($request) {
                        if ($request->semesters_id > 0) {
                            $query->where('semesters_id', '=', $request->semesters_id);
                            $this->filter_query['semesters_id'] = $request->semesters_id;
                        }

                        if ($request->subjects_id > 0) {
                            $query->where('subjects_id', '=', $request->subjects_id);
                            $this->filter_query['subjects_id'] = $request->subjects_id;
                        }

                        if ($request->has('title') ) {
                            $query->where('title', 'like', '%'.$request->title.'%');
                            $this->filter_query['title'] = $request->title;
                        }

                        if ($request->has('created_date_start') && $request->has('created_date_end')) {
                            $query->whereBetween('created_at', [$request->get('created_date_start'), $request->get('created_date_end')]);
                            $this->filter_query['created_date_start'] = $request->get('created_date_start');
                            $this->filter_query['created_date_end'] = $request->get('created_date_end');
                        }
                        elseif ($request->has('created_date_start')) {
                            $query->where('created_at', '>=', $request->get('created_date_start'));
                            $this->filter_query['created_date_start'] = $request->get('created_date_start');
                        }
                        elseif($request->has('created_date_end')) {
                            $query->where('created_at', '<=', $request->get('created_date_end'));
                            $this->filter_query['created_date_end'] = $request->get('created_date_end');
                        }

                        if ($request->has('status')) {
                            $query->where('status', $request->status == 'active'?1:0);
                            $this->filter_query['status'] = $request->get('status');
                        }

                    })
                    ->latest()
                    ->get();
            }else{
                $data['download'] = Download::latest()
                    ->where(function ($query) use ($request) {
                        if ($request->semesters_id > 0) {
                            $query->where('semesters_id', '=', $request->semesters_id);
                            $this->filter_query['semesters_id'] = $request->semesters_id;
                        }

                        if ($request->subjects_id > 0) {
                            $query->where('subjects_id', '=', $request->subjects_id);
                            $this->filter_query['subjects_id'] = $request->subjects_id;
                        }

                        if ($request->has('title') ) {
                            $query->where('title', 'like', '%'.$request->title.'%');
                            $this->filter_query['title'] = $request->title;
                        }

                        if ($request->has('created_date_start') && $request->has('created_date_end')) {
                            $query->whereBetween('created_at', [$request->get('created_date_start'), $request->get('created_date_end')]);
                            $this->filter_query['created_date_start'] = $request->get('created_date_start');
                            $this->filter_query['created_date_end'] = $request->get('created_date_end');
                        }
                        elseif ($request->has('created_date_start')) {
                            $query->where('created_at', '>=', $request->get('created_date_start'));
                            $this->filter_query['created_date_start'] = $request->get('created_date_start');
                        }
                        elseif($request->has('created_date_end')) {
                            $query->where('created_at', '<=', $request->get('created_date_end'));
                            $this->filter_query['created_date_end'] = $request->get('created_date_end');
                        }

                        if ($request->has('status')) {
                            $query->where('status', $request->status == 'active'?1:0);
                            $this->filter_query['status'] = $request->get('status');
                        }

                    })
                    ->get();
            }
        }else{
            if(auth()->user()->hasRole('staff')) {
                $id = auth()->user()->id;
                $data['download'] = Download::where('created_by',$id)
                    ->latest()
                    ->get();


            }else {
                $data['download'] = Download::latest()
                    ->get();
            }
        }

        $data['faculties'] = $this->activeFaculties();

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
        if(auth()->user()->hasRole('staff')) {
            if($request->subjects_id > 0){
            }else{
                $request->session()->flash($this->message_warning, 'Please Upload with related Subject.');
                return redirect()->route($this->base_route);
            }
        }

        if($request->hasFile('download_file')){
        }else{
            $request->session()->flash($this->message_warning, 'Please Upload with attachment file.');
            return redirect()->route($this->base_route);
        }

        $name = str_slug($request->get('title'));

        if ($request->hasFile('download_file')){
            $file = $request->file('download_file');
            $file_name = rand(4585, 9857).'_'.$name.'.'.$file->getClientOriginalExtension();
            $file->move($this->folder_path, $file_name);

            $request->request->add(['created_by' => auth()->user()->id]);
            $request->request->add(['semesters_id' => $request->get('semesters_id')]);
            $request->request->add(['file' => $file_name]);

            Download::create($request->all());

            $request->session()->flash($this->message_success, $this->panel. ' Uploaded Successfully.');
            return redirect()->route($this->base_route);
        }else{
            $request->session()->flash($this->message_warning, 'File Not Uploaded Yet or File Not Selected');
            return back();
        }

    }

    public function edit(Request $request, $id)
    {
        $id = decrypt($id);
        $data = [];
        $data['row'] = Download::find($id);
        if (!$data['row'])
            return parent::invalidRequest();

        if(auth()->user()->hasRole('staff')) {
            $UserId = auth()->user()->id;
            if($data['row']->created_by != $UserId){
                return parent::invalidRequest();
            }
        }

        $data['faculties'] = $this->activeFaculties();

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Download::find($id)) return parent::invalidRequest();

        $name = str_slug($request->get('title'));

        if ($request->hasFile('download_file')) {
            $file = $request->file('download_file');
            $file_name = rand(4585, 9857) . '_' . $name . '.' . $file->getClientOriginalExtension();
            $file->move($this->folder_path, $file_name);

            if ($row->file && file_exists($this->folder_path.$row->file)) {
                @unlink($this->folder_path.$row->file);
            }
        }

        if($request->has('semesters_id') && is_numeric($request->get('semesters_id') && $request->get('semesters_id') > 0)) {
            $request->request->add(['semesters_id' => $request->get('semesters_id')]);
        }


        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['file' => isset($file_name)?$file_name:$row->file]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Download::find($id)) return parent::invalidRequest();

        if(auth()->user()->hasRole('staff')) {
            $UserId = auth()->user()->id;
            if($row->created_by != $UserId){
                return parent::invalidRequest();
            }
        }

        // remove old image from folder
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
                    $row_id = decrypt($row_id);
                    switch ($request->get('bulk_action')) {
                        case 'active':
                        case 'in-active':
                            $row = Download::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Download::find($row_id);
                            if(auth()->user()->hasRole('staff')) {
                                $UserId = auth()->user()->id;
                                if($row->created_by != $UserId){
                                    return parent::invalidRequest();
                                }
                            }
                            if ($row->file && file_exists($this->folder_path.$row->file)) {
                                @unlink($this->folder_path.$row->file);
                            }
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
        $id = decrypt($id);
        if (!$row = Download::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);
        $row->update($request->all());
        $request->session()->flash($this->message_success, $this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Download::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);
        $row->update($request->all());
        $request->session()->flash($this->message_success, $this->panel.' In-Active Successfully.');
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
            $response['success'] = 'Subjects Found, Select Subject and Manage Download.';
        }else {
            $response['error'] = 'No Any Subject Found. Please Contact Your Administrator.';
        }

        return response()->json(json_encode($response));
    }
}