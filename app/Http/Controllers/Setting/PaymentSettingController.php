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

use App\Models\EmailSetting;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends CollegeBaseController
{
    protected $base_route = 'setting.payment-gateway';
    protected $view_path = 'setting.payment';
    protected $panel = 'Payment Setting';

    public function __construct()
    {

    }

    public function index()
    {
        $data['paymentGateway'] = PaymentSetting::all();
        $configurations = [];

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $data = [];
        $permissions = Permission::all();
        $data['permission'] = $permissions->groupBy('group');
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($request->except(['permission','_token']));

        foreach($request->permission as $key => $value){
            $role->attachPermission($value);
        }

        $request->session()->flash($this->message_success, $this->panel. ' successfully added.');
        return redirect()->route($this->base_route);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$paymentSetting = PaymentSetting::find($id)) return parent::invalidRequest();
        $fetchData = $request->except('_token');
        $config = json_encode($fetchData);
        $paymentSetting->update([
            'config' => $config
        ]);

        $request->session()->flash($this->message_success, $this->panel. ' successfully updated.');
        return redirect()->route($this->base_route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        /*Delete Previous Permission*/
        DB::table('paymentGateway')->where('id', $id)->delete();

        $request->session()->flash($this->message_success, $this->panel. ' delete successfully.');
        return redirect()->route($this->base_route);
    }


    public function active(request $request, $id)
    {
        if (!$row = PaymentSetting::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());
        PaymentSetting::whereNotIn('id',[$id])->update(['status' => 0]);

        $request->session()->flash($this->message_success, $row->reg_no.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = PaymentSetting::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->reg_no.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

}