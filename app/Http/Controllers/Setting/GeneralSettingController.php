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

use App\Http\Requests\Setting\General\AddValidation;
use App\Http\Requests\Setting\General\EditValidation;
use App\Models\GeneralSetting;
use App\Models\TimeZone;
use App\Traits\EnvironmentScope;
use Illuminate\Http\Request;

class GeneralSettingController extends CollegeBaseController
{
    protected $base_route = 'setting.general';
    protected $view_path = 'setting.general';
    protected $panel = 'General Setting';
    protected $folder_path;
    protected $folder_name = 'general';
    protected $filter_query = [];

    use EnvironmentScope;

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR;
    }

    public function index(Request $request)
    {
        $data = [];
        $data['row'] = GeneralSetting::first();

        $data['url'] = '';

        $timezones = TimeZone::pluck('timezone','id')->toArray();
        $data['timezones'] = array_prepend($timezones,'Select TimeZone','0');



        if($data['row']){
            return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
        }else{
            return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
        }

    }

    public function add()
    {
        $data = [];
        $data['row'] = GeneralSetting::first();
        if($data['row']){
            return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
        };

        $timezones = TimeZone::pluck('timezone','id')->toArray();
        $data['timezones'] = array_prepend($timezones,'Select TimeZone','0');

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $data['row'] = GeneralSetting::first();
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

        GeneralSetting::create($request->all());

        if($request->time_zones_id > 0){
            $timeZone = TimeZone::find($request->time_zones_id);
            $timeZone->update(['status'=>1]);
            TimeZone::where('id','!=',$request->time_zones_id)->update(['status'=>0]);
            $this->setEnv('APP_TIMEZONE', $timeZone->timezone);
        }

        $request->session()->flash($this->message_success, $this->panel. ' successfully added.');
        return redirect()->route($this->view_path);
    }


    public function edit(Request $request, $id)
    {
        $data = [];
        if (!$data['row'] = GeneralSetting::find($id))
            return parent::invalidRequest();

        $timezones = TimeZone::pluck('timezone','id')->toArray();
        $data['timezones'] = array_prepend($timezones,'Select TimeZone','0');

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        if (!$row = GeneralSetting::find($id)) return parent::invalidRequest();

        if ($request->hasFile('logo_image')){
            $logo_name = parent::uploadImages($request, 'logo_image');
            // remove old image from folder
            if (file_exists($this->folder_path.$row->logo))
                @unlink($this->folder_path.$row->logo);
        }

        if ($request->hasFile('favicon_image')){
            $favicon_name = parent::uploadImages($request, 'favicon_image');
            // remove old image from folder
            if (file_exists($this->folder_path.$row->favicon))
                @unlink($this->folder_path.$row->favicon);
        }

        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['favicon' => isset($favicon_name)?$favicon_name:$row->favicon]);
        $request->request->add(['logo' => isset($logo_name)?$logo_name:$row->logo]);
        $row->update($request->all());

        if($request->time_zones_id > 0){
            $timeZone = TimeZone::find($request->time_zones_id);
            $timeZone->update(['status'=>1]);
            TimeZone::where('id','!=',$request->time_zones_id)->update(['status'=>0]);
            $this->setEnv('APP_TIMEZONE', $timeZone->timezone);
        }

        $request->session()->flash($this->message_success, $this->panel.' successfully updated.');
        return redirect()->route($this->base_route);
    }

}