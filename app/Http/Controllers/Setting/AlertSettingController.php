<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */
/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 02/04/2018
 * Time: 12:38 PM
 */
namespace App\Http\Controllers\Setting;

use App\Http\Controllers\CollegeBaseController;
use App\Models\AlertSetting;
use Illuminate\Http\Request;

class AlertSettingController extends CollegeBaseController
{
    protected $base_route = 'setting.alert';
    protected $view_path = 'setting.alert';
    protected $panel = 'Alert Template';

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['row'] = AlertSetting::select('id','created_by', 'last_updated_by', 'event', 'sms', 'email', 'subject', 'template',
                        'status')->get();

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add()
    {
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(Request $request)
    {

        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['sms' => $request->sms?$request->sms:0]);
        $request->request->add(['email' => $request->email?$request->email:0]);

        AlertSetting::create($request->all());

        $request->session()->flash($this->message_success, $this->panel. ' successfully added.');
        return redirect()->route($this->view_path);
    }


    public function edit(Request $request, $id)
    {

        $data = [];
        if (!$data['row'] = AlertSetting::find($id))
            return parent::invalidRequest();

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(Request $request, $id)
    {
        if (!$row = AlertSetting::find($id)) return parent::invalidRequest();

        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['sms' => $request->sms?$request->sms:0]);
        $request->request->add(['email' => $request->email?$request->email:0]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' successfully updated.');
        return redirect()->route($this->base_route);
    }

}