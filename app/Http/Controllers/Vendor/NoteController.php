<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Vendor\Notes\AddValidation;
use App\Http\Requests\Vendor\Notes\EditValidation;
use App\Models\Note;
use App\Models\Vendor;
use Illuminate\Http\Request;
use ViewHelper;
use view;

class NoteController extends CollegeBaseController
{
    protected $base_route = 'vendor.note';
    protected $view_path = 'vendor.note';
    protected $panel = 'Vendor Notes';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['note'] = Note::select('created_at', 'id', 'member_type','member_id','subject', 'note', 'status')
            ->where('member_type','=','vendor')
            ->get();

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $reg_no = $request->get('reg_no');

        $vendor = Vendor::select('id')->where('reg_no','=',$reg_no)->first();
        if (!$vendor)
            return redirect()->route('vendor.note')->with('message_warning', 'Please Check Registration Number. 
            This Registration Number is Not a valid Vendor Registration No.');


        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['member_id' => $vendor->id]);
        $request->request->add(['member_type' => 'vendor']);

       Note::create($request->all());

       $request->session()->flash($this->message_success, $this->panel. ' Create Successfully.');
       return redirect()->route($this->base_route);
    }

    public function edit(Request $request, $id)
    {
        $id = decrypt($id);
        $data = [];
        $data['row'] = Note::find($id);
        if (!$data['row'])
            return parent::invalidRequest();

        $reg_no = Vendor::select('reg_no')->where('id','=',$data['row']->member_id)->first();
        $data['row']->reg_no = $reg_no->reg_no;
        $data['note'] = Note::select('created_at', 'id', 'member_type','member_id','subject', 'note', 'status')
                        ->where('member_type','=','vendor')
                        ->get();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Note::find($id)) return parent::invalidRequest();

        $reg_no = $request->get('reg_no');
        $vendor = Vendor::select('id')->where('reg_no','=',$reg_no)->first();
        if (!$vendor)
            return redirect()->route('vendor.note')->with('message_warning', 'Please Check Registration Number. 
            This Registration Number is Not a valid Vendor Registration No.');

        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['member_id' => $vendor->id]);
        $request->request->add(['member_type' => 'vendor']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Note::find($id)) return parent::invalidRequest();

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
                            $row = Note::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Note::find($row_id);
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
        if (!$row = Note::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);


        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Note::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }
}