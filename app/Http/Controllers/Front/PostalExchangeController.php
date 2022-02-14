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
use App\Http\Requests\Front\PostalExchange\AddValidation;
use App\Http\Requests\Front\PostalExchange\EditValidation;
use App\Models\PostalExchange;
use App\Models\PostalExchangeType;
use App\Traits\HostelScope;
use App\Traits\SmsEmailScope;
use Illuminate\Http\Request;
use URL;

class PostalExchangeController extends CollegeBaseController
{
    protected $base_route = 'front.postal-exchange';
    protected $view_path = 'front.postal-exchange';
    protected $panel = 'Postal Exchange';
    protected $folder_path;
    protected $folder_name = 'postalExchange';
    protected $filter_query = [];

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR;

    }

    public function index(Request $request)
    {
        $data = [];
        if($request->all()){
            $data['postal-exchange'] = PostalExchange::where(function ($query) use ($request) {

                if ($request->get('type')) {
                    $query->where('type', '=', $request->type);
                    $this->filter_query['type'] = $request->type;
                }

                if ($request->get('ref_no')) {
                    $query->where('ref_no', '=', $request->ref_no);
                    $this->filter_query['ref_no'] = $request->ref_no;
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

                if ($request->has('subject')) {
                    $query->where('subject', '=', $request->subject);
                    $this->filter_query['subject'] = $request->subject;
                }

                if ($request->has('to')) {
                    $query->where('to', '=', $request->to);
                    $this->filter_query['to'] = $request->to;
                }

                if ($request->has('from')) {
                    $query->where('from', '=', $request->from);
                    $this->filter_query['from'] = $request->from;
                }

            })
                ->get();
        }else{
            $data['postal-exchange'] = PostalExchange::whereYear('date', '=', date('Y'))
                ->get();
        }

        $types = PostalExchangeType::select('id', 'title')->Active()->orderBy('title')->get();
        $map_types = array_pluck($types,'title','title');
        $data['exchange_type'] = array_prepend($map_types,'Select Type...','');

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];

        $types = PostalExchangeType::select('id', 'title')->Active()->orderBy('title')->get();
        $map_types = array_pluck($types,'title','title');
        $data['exchange_type'] = array_prepend($map_types,'Select Type...','');

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

        PostalExchange::create($request->all());

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
        if (!$data['row'] = PostalExchange::find($id))
            return parent::invalidRequest();

        $types = PostalExchangeType::select('id', 'title')->Active()->orderBy('title')->get();
        $map_types = array_pluck($types,'title','title');
        $data['exchange_type'] = array_prepend($map_types,'Select Type...','');

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        $id = decrypt($id);

        if (!$row = PostalExchange::find($id)) return parent::invalidRequest();

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
        $id = decrypt($id);

        if (!$row = PostalExchange::find($id)) return parent::invalidRequest();

        if (file_exists($this->folder_path.$row->attachment))
            @unlink($this->folder_path.$row->attachment);

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkAction(Request $request)
    {

        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    $row = PostalExchange::find(decrypt($row_id));
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