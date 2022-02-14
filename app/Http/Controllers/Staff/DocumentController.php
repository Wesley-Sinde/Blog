<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Staff\Document\AddValidation;
use App\Http\Requests\Staff\Document\EditValidation;
use App\Models\Document;
use App\Models\Staff;
use Illuminate\Http\Request;
use ViewHelper;
use view;

class DocumentController extends CollegeBaseController
{
    protected $base_route = 'staff.document';
    protected $view_path = 'staff.document';
    protected $panel = 'Staff Document';
    protected $folder_path;
    protected $folder_name = 'documents';
    protected $filter_query = [];

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR.'staff'.DIRECTORY_SEPARATOR;
    }

    public function index(Request $request)
    {
        $data = [];
        $data['document'] = Document::select('id', 'member_type','member_id', 'title', 'file', 'status')
            ->where('member_type','=','staff')
            ->get();

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $reg_no = $request->get('reg_no');

        $staff = Staff::select('id')->where('reg_no','=',$reg_no)->first();
        if (!$staff)
            return redirect()->route('student.document')->with('message_warning', 'Please Check Staff Registration Number. This Registration Number is Not a valid Staff Registration.');

        $name = str_slug($request->get('title'));

        if ($request->hasFile('document_file')){
            $document_file = parent::uploadFile($request, $reg_no , $name ,'document_file');
        }

        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['member_id' => $staff->id]);
        $request->request->add(['file' => $document_file]);
        $request->request->add(['member_type' => 'staff']);

        Document::create($request->all());

        $request->session()->flash($this->message_success, $this->panel. ' Uploaded Successfully.');
        return redirect()->route($this->base_route);
    }

    public function edit(Request $request, $id)
    {
        $data = [];
        $data['row'] = Document::find($id);
        if (!$data['row'])
            return parent::invalidRequest();

        $reg_no = Staff::select('reg_no')->where('id','=',$data['row']->member_id)->first();
        $data['row']->reg_no = $reg_no->reg_no;
        $data['document'] = Document::select('id', 'member_id','member_type','title', 'file', 'status')
            ->where('member_type','=','staff')
            ->get();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        if (!$row = Document::find($id)) return parent::invalidRequest();

        $reg_no = $request->get('reg_no');
        $student = Staff::select('id')->where('reg_no','=',$reg_no)->first();
        $name = str_slug($request->get('title'));

        if ($request->hasFile('document_file')){
            $document_file = parent::uploadFile($request, $reg_no , $name ,'document_file');
            @unlink($this->folder_path.$reg_no.DIRECTORY_SEPARATOR.$row->file);
        }

        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['member_id' => $student->id]);
        $request->request->add(['member_type' => 'staff']);
        $request->request->add(['file' => isset($document_file)?$document_file:$row->file]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Document::find($id)) return parent::invalidRequest();

        $reg_no = parent::getStaffById($row->students_id);
        // remove old image from folder
        if ($row->file && file_exists($this->folder_path.DIRECTORY_SEPARATOR.$reg_no.DIRECTORY_SEPARATOR.$row->file)) {
            @unlink($this->folder_path.DIRECTORY_SEPARATOR.$reg_no.DIRECTORY_SEPARATOR.$row->file);
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
                            $row = Document::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Document::find($row_id);
                            $reg_no = Staff::select('reg_no')->where('id','=',$row->member_id)->first();
                            // remove old image from folder
                            if ($row->file && file_exists($this->folder_path.$reg_no->reg_no.DIRECTORY_SEPARATOR.$row->file)) {
                                @unlink($this->folder_path.$reg_no->reg_no.DIRECTORY_SEPARATOR.$row->file);
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
        if (!$row = Document::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);


        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = Document::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }
}