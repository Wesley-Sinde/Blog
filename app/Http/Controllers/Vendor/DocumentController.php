<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Vendor\Document\AddValidation;
use App\Http\Requests\Vendor\Document\EditValidation;
use App\Models\Document;
use App\Models\Vendor;
use Illuminate\Http\Request;
use ViewHelper;
use view;

class DocumentController extends CollegeBaseController
{
    protected $base_route = 'vendor.document';
    protected $view_path = 'vendor.document';
    protected $panel = 'Vendor Documents';
    protected $folder_path;
    protected $folder_name = 'documents';
    protected $filter_query = [];

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR;
    }

    public function index(Request $request)
    {
        $data = [];
        $data['document'] = Document::select('id', 'member_type','member_id', 'title', 'file', 'status')
            ->where('member_type','=','vendor')
            ->get();

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $reg_no = $request->get('reg_no');
        $vendor = Vendor::select('id')->where('reg_no','=',$reg_no)->first();
        if (!$vendor)
            return redirect()->route('vendor.document')->with('message_warning', 'Please Check Vendor Registration Number. This Registration Number is Not a valid Vendor Registration.');

        $name = str_slug($request->get('title'));

        if ($request->hasFile('document_file')){
            $document_file = parent::uploadFile($request, $reg_no , $name ,'document_file');

            $request->request->add(['created_by' => auth()->user()->id]);
            $request->request->add(['member_id' => $vendor->id]);
            $request->request->add(['file' => $document_file]);
            $request->request->add(['member_type' => 'vendor']);

            Document::create($request->all());

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
        $data['row'] = Document::find($id);
        if (!$data['row'])
            return parent::invalidRequest();

        $reg_no = Vendor::select('reg_no')->where('id','=',$data['row']->member_id)->first();
        $data['row']->reg_no = $reg_no->reg_no;
        $data['document'] = Document::select('id', 'member_id','member_type','title', 'file', 'status')
                            ->where('member_type','=','vendor')
                            ->get();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Document::find($id)) return parent::invalidRequest();

        $reg_no = $request->get('reg_no');
        $vendor = Vendor::select('id')->where('reg_no','=',$reg_no)->first();
        $name = str_slug($request->get('title'));

       if ($request->hasFile('document_file')){
           $document_file = parent::uploadFile($request, $reg_no , $name ,'document_file');
           @unlink($this->folder_path.$reg_no.DIRECTORY_SEPARATOR.$row->file);
       }

        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['member_id' => $vendor->id]);
        $request->request->add(['member_type' => 'vendor']);
        $request->request->add(['file' => isset($document_file)?$document_file:$row->file]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Document::find($id)) return parent::invalidRequest();

        $reg_no = parent::getVendorRegById($row->member_id);
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
                    $row_id = decrypt($row_id);
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
                            $reg_no = Vendor::select('reg_no')->where('id','=',$row->member_id)->first();
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
        $id = decrypt($id);
        if (!$row = Document::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);
        $row->update($request->all());
        $request->session()->flash($this->message_success, $this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Document::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);
        $row->update($request->all());
        $request->session()->flash($this->message_success, $this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }
}