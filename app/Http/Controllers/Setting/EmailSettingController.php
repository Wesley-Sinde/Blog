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
use App\Traits\EnvironmentScope;
use Illuminate\Http\Request;

class EmailSettingController extends CollegeBaseController
{
    protected $base_route = 'setting.email';
    protected $view_path = 'setting.email';
    protected $panel = 'Email Setting';

    use EnvironmentScope;

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['row'] = EmailSetting::select('id','created_by', 'last_updated_by', 'driver', 'host', 'port', 'user_name', 'password', 'encryption','status')->first();

        $data['url'] = '';

        if($data['row']){
            return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
        }else{
            return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
        }

    }

    public function add()
    {
        $data = [];
        $data['row'] = EmailSetting::first();
        if($data['row']){
            return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
        };
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(Request $request)
    {
        $data['row'] = EmailSetting::first();
        if($data['row']){
            return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
        };

        if ($request->hasFile('favicon_image')){
            $favicon_name = parent::uploadImages($request, 'favicon_image');
        }else{
            $favicon_name = "";
        }

        if ($request->hasFile('logo_image')){
            $logo_name = parent::uploadImages($request, 'logo_image');
        }else{
            $logo_name = "";
        }

        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['favicon' => $favicon_name]);
        $request->request->add(['logo' => $logo_name]);

        EmailSetting::create($request->all());

        /*set values on .env*/
        $this->setEnv('MAIL_DRIVER', "$request->driver");
        $this->setEnv('MAIL_HOST', "$request->host");
        $this->setEnv('MAIL_PORT', "$request->port");
        $this->setEnv('MAIL_USERNAME', "$request->user_name");
        $this->setEnv('MAIL_PASSWORD', "$request->password");
        $this->setEnv('MAIL_ENCRYPTION', "$request->encryption");

        $request->session()->flash($this->message_success, $this->panel. ' successfully added.');
        return redirect()->route($this->view_path);
    }

    public function edit(Request $request, $id)
    {

        $data = [];
        if (!$data['row'] = EmailSetting::find($id))
            return parent::invalidRequest();

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(Request $request, $id)
    {
        if (!$row = EmailSetting::find($id)) return parent::invalidRequest();
        $row->update($request->all());

        /*set values on .env*/
        $this->setEnv('MAIL_DRIVER', $request->driver);
        $this->setEnv('MAIL_HOST', $request->host);
        $this->setEnv('MAIL_PORT', $request->port);
        $this->setEnv('MAIL_USERNAME', $request->user_name);
        $this->setEnv('MAIL_PASSWORD', $request->password);
        $this->setEnv('MAIL_ENCRYPTION', $request->encryption);

        $request->session()->flash($this->message_success, $this->panel.' successfully updated.');
        return redirect()->route($this->base_route);
    }

    public function statusChange(request $request)
    {
        if (!$row = EmailSetting::find($request->id)) return parent::invalidRequest();

        $request->request->add(['status' => $request->status]);

        $response = $row->update($request->all());
        return response()->json(json_encode($response));
    }


}