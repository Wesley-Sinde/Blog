<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\CollegeBaseController;

use App\Http\Requests\Certificate\Template\AddValidation;
use App\Http\Requests\Certificate\Template\EditValidation;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\CertificateTemplate;
use App\Models\BookStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use URL;
use ViewHelper;
class TemplateController extends CollegeBaseController
{
    protected $base_route = 'certificate.template';
    protected $view_path = 'certificate.template';
    protected $panel = 'Certificate Template';
    protected $folder_path;
    protected $folder_name = 'certificateBackground';
    protected $filter_query = [];

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR;
    }

    public function index(Request $request)
    {
        $data = [];
        $data['templates'] = CertificateTemplate::get();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];
        $data['url'] = URL::current();
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        if ($request->hasFile('background_main_image')){
            $background_image = $request->file('background_main_image');
            $background_image_name = str_slug($request->certificate).'.'.$background_image->getClientOriginalExtension();
            $background_image->move($this->folder_path, $background_image_name);
        }else{
            $background_image_name = "";
        }

        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['background_image' => $background_image_name]);

        $row = CertificateTemplate::create($request->all());

        $request->session()->flash($this->message_success, $this->panel. ' Add Successfully.');
        return redirect()->route($this->base_route);
    }

    public function edit(Request $request, $id)
    {
        $data = [];
        $data['row'] = CertificateTemplate::where('id','=',$id)
                            ->first();

        if (!$data['row'])
            return parent::invalidRequest();

        $data['url'] = URL::current();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        if (!$row = CertificateTemplate::find($id)) return parent::invalidRequest();

        if ($request->hasFile('background_main_image')) {
            // remove old image from folder
            if (file_exists($this->folder_path.$row->background_image))
                @unlink($this->folder_path.$row->background_image);

            /*upload new student image*/
            $background_image = $request->file('background_main_image');
            $background_image_name = str_slug($request->certificate).'.'.$background_image->getClientOriginalExtension();
            $background_image->move($this->folder_path, $background_image_name);
        }

        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['background_image' => isset($background_image_name)?$background_image_name:$row->background_image]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return back();
    }


    public function delete(Request $request, $id)
    {
        if (!$row = CertificateTemplate::find($id)) return parent::invalidRequest();

        $row->delete();
        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    switch ($request->get('bulk_action')) {
                        case 'active':
                        case 'in-active':
                            $row = CertificateTemplate::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = CertificateTemplate::find($row_id);
                            $row->delete();
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, $request->get('bulk_action'). ' Action Successfully.');
                else
                    $request->session()->flash($this->message_success, ' Deleted successfully.');

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }

    public function active(request $request, $id)
    {
        if (!$row = CertificateTemplate::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = CertificateTemplate::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }


}
