<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Front;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Front\Visitor\AddValidation;
use App\Http\Requests\Front\Visitor\EditValidation;
use App\Models\PostalExchange;
use App\Models\VisitorPurpose;
use App\Models\VisitorLog;
use App\Traits\HostelScope;
use App\Traits\SmsEmailScope;
use Illuminate\Http\Request;
use URL;

class VisitorController extends CollegeBaseController
{
    protected $base_route = 'front.visitor';
    protected $view_path = 'front.visitor-log';
    protected $panel = 'Visitor Logs';
    protected $folder_path;
    protected $folder_name = 'visitorLog';
    protected $filter_query = [];

    use HostelScope;
    use SmsEmailScope;

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR;

    }

    public function index(Request $request)
    {
        $data = [];

        if($request->all()){

            $data['visitor'] = VisitorLog::where(function ($query) use ($request) {

                /*
                      "status" => "active"
                 * */

                if ($request->get('token')) {
                    $query->where('token', '=', $request->token);
                    $this->filter_query['token'] = $request->token;
                }

                if ($request->get('purpose')) {
                    $query->where('purpose', '=', $request->purpose);
                    $this->filter_query['purpose'] = $request->purpose;
                }

                if ($request->has('start_date') && $request->has('end_date')) {
                    $query->whereBetween('date', [$request->get('start_date'), $request->get('end_date')]);
                    $this->filter_query['start_date'] = $request->get('start_date');
                    $this->filter_query['end_date'] = $request->get('end_date');
                } elseif ($request->has('start_date')) {
                    $query->where('date', '=', $request->get('start_date'));
                    $this->filter_query['start_date'] = $request->get('start_date');
                } elseif ($request->has('end_date')) {
                    $query->where('date', '=', $request->get('end_date'));
                    $this->filter_query['end_date'] = $request->get('end_date');
                }

                if ($request->get('in_time')) {
                    $query->where('in_time', '=', $request->in_time);
                    $this->filter_query['in_time'] = $request->in_time;
                }

                if ($request->get('out_time')) {
                    $query->where('out_time', '=', $request->out_time);
                    $this->filter_query['out_time'] = $request->out_time;
                }

                if ($request->get('name')) {
                    $query->where('name', '=', $request->name);
                    $this->filter_query['name'] = $request->name;
                }

                if ($request->get('phone')) {
                    $query->where('phone', '=', $request->phone);
                    $this->filter_query['phone'] = $request->phone;
                }

                if ($request->get('email')) {
                    $query->where('email', '=', $request->email);
                    $this->filter_query['email'] = $request->email;
                }

                if ($request->get('id_doc')) {
                    $query->where('id_doc', '=', $request->id_doc);
                    $this->filter_query['id_doc'] = $request->id_doc;
                }

                if ($request->get('id_num')) {
                    $query->where('id_num', '=', $request->id_num);
                    $this->filter_query['id_num'] = $request->id_num;
                }

                if ($request->has('status')) {
                    $query->where('status', $request->status == 'active' ? 1 : 0);
                    $this->filter_query['status'] = $request->get('status');
                }


            })
                ->get();
        }else{
            $data['visitor'] = VisitorLog::where('date', '=', date('Y-m-d'))
                ->get();
        }

        $purpose = VisitorPurpose::select('id', 'title')->Active()->orderBy('title')->get();
        $map_types = array_pluck($purpose,'title','title');
        $data['purpose'] = array_prepend($map_types,'Select Type...','');

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];

        $purpose = VisitorPurpose::select('id', 'title')->Active()->orderBy('title')->get();
        $map_types = array_pluck($purpose,'title','title');
        $data['purpose'] = array_prepend($map_types,'Select Type...','');

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(AddValidation $request)
    {

        if ($request->hasFile('file')){
            $attachment_file = $request->file('file');
            $attachment_file_name = mt_rand(0, 9).'_'.$request->file('ref_no').'.'.$attachment_file->getClientOriginalExtension();
            $attachment_file->move($this->folder_path, $attachment_file_name);
        }else{
            $attachment_file_name = '';
        }

        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['attachment' => $attachment_file_name]);

        VisitorLog::create($request->all());

        $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');

        if($request->add_exchange_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }

    }

    public function edit(Request $request, $id)
    {
        $id = decrypt($id);
        $data = [];
        if (!$data['row'] = VisitorLog::find($id))
            return parent::invalidRequest();

        $purpose = VisitorPurpose::select('id', 'title')->Active()->orderBy('title')->get();
        $map_types = array_pluck($purpose,'title','title');
        $data['purpose'] = array_prepend($map_types,'Select Type...','');

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        $id = decrypt($id);

        if (!$row = VisitorLog::find($id)) return parent::invalidRequest();

        if ($request->hasFile('file')){
            if (file_exists($this->folder_path.$row->attachment))
                @unlink($this->folder_path.$row->attachment);

            $attachment_file = $request->file('file');
            $attachment_file_name = mt_rand(0, 9).'_'.$request->get('ref_no').'.'.$attachment_file->getClientOriginalExtension();
            $attachment_file->move($this->folder_path, $attachment_file_name);
        }else{
            $attachment_file_name = $row->attachment;
        }

        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['attachment' => $attachment_file_name]);

        $row->update($request->all());

        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = VisitorLog::find($id)) return parent::invalidRequest();

        if (file_exists($this->folder_path.$row->attachment))
            @unlink($this->folder_path.$row->attachment);

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function active(request $request, $id)
    {
        if (!$row = VisitorLog::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = VisitorLog::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkAction(Request $request)
    {


        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    $row = VisitorLog::find($row_id);
                    if ($row) {
                        switch ($request->get('bulk_action')) {
                            case 'active':
                            case 'in-active':
                                $row->status = $request->get('bulk_action') == 'active' ? 'active' : 'in-active';
                                $row->save();
                                break;
                            case 'delete':
                                if (file_exists($this->folder_path . $row->attachment))
                                    @unlink($this->folder_path . $row->attachment);

                                $this->delete($request, $row_id);
                                break;
                        }
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active') {
                    $request->session()->flash($this->message_success, $request->get('bulk_action') . ' Action Successfully.');
                }else {
                    $request->session()->flash($this->message_success, 'Deleted successfully.');
                }

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }

}