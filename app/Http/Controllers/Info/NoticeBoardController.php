<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Info;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Notice\AddValidation;
use App\Http\Requests\Notice\EditValidation;
use App\Models\Notice;
use App\Role;
use Illuminate\Http\Request;

class NoticeBoardController extends CollegeBaseController
{
    protected $base_route = 'info.notice';
    protected $view_path = 'info.notice';
    protected $panel = 'User Notice';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['rows'] = Notice::select('id', 'title', 'message', 'publish_date', 'end_date', 'display_group','status')
            ->latest()
            ->get();
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));

    }

    public function add()
    {
        $data = [];
        $data['roles'] = Role::where('id','<>','1')->get();
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));

    }

    public function store(AddValidation $request)
    {
        if($request->has('role')) {
            $display_group = implode(',', $request->get('role'));
        }
        $request->request->add(['display_group' => isset($display_group)?$display_group:'']);

        $request->request->add(['created_by' => auth()->user()->id]);
       Notice::create($request->all());
       $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');

       if($request->add_notice_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }
    }

    public function edit(Request $request, $id)
    {
        $data = [];
        if (!$data['row'] = Notice::find($id))
            return parent::invalidRequest();

        $data['roles'] = Role::where('id','<>','1')->get();
        $roleactive = explode(',',$data['row']->display_group);
        $data['access_role'] = $roleactive;

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
       if (!$row = Notice::find($id)) return parent::invalidRequest();

        $request->request->add(['last_updated_by' => auth()->user()->id]);

        if($request->has('role')) {
            $display_group = implode(',',$request->get('role'));
        }
        $request->request->add(['display_group' => isset($display_group)?$display_group:'']);


        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Notice::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

}