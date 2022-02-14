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
use App\Models\MeetingSetting;
use App\Traits\EnvironmentScope;
use Illuminate\Http\Request;

class MeetingSettingController extends CollegeBaseController
{
    protected $base_route = 'setting.meeting';
    protected $view_path = 'setting.meeting';
    protected $panel = 'Meeting Setting';

    use EnvironmentScope;

    public function __construct()
    {

    }

    public function index()
    {
        $data['meetingSetting'] = MeetingSetting::orderBy('identity')->get();
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        if (!$meetingSetting = MeetingSetting::find($id)) return parent::invalidRequest();
        $fetchData = $request->except('_token','identity');
        $config = json_encode($fetchData);
        $meetingSetting->update([
            'config' => $config
        ]);

        /*set values on .env*/
        if($meetingSetting->identity == 'Zoom'){
            $this->setEnv('ZOOM_KEY', "$request->Key");
            $this->setEnv('ZOOM_SECRET', "$request->Secret");
        }

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

    }


    public function active(request $request, $id)
    {
        if (!$row = MeetingSetting::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

       $row->update($request->all());
       MeetingSetting::whereNotIn('id',[$id])->update(['status' => 0]);

        $request->session()->flash($this->message_success, $row->reg_no.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = MeetingSetting::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->reg_no.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

}