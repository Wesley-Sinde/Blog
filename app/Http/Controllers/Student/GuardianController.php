<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Student;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Guardian\Registration\AddValidation;
use App\Http\Requests\Guardian\Registration\EditValidation;
use App\Models\GuardianDetail;
use App\Models\Student;
use App\Models\StudentGuardian;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class GuardianController extends CollegeBaseController
{
    protected $base_route = 'guardian';
    protected $view_path = 'guardian';
    protected $panel = 'Guardian';
    protected $folder_path;
    protected $folder_name = 'studentProfile';
    protected $filter_query = [];

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR;
    }

    public function index(Request $request)
    {
        $data = [];
        $data['guardian'] = GuardianDetail::select('id', 'guardian_first_name', 'guardian_middle_name', 'guardian_last_name',
            'guardian_residence_number', 'guardian_mobile_1', 'guardian_address','status')
            ->where('guardian_first_name', 'like', '%'.$request->get('q').'%')
            ->orWhere('guardian_middle_name', 'like', '%'.$request->get('q').'%')
            ->orWhere('guardian_last_name', 'like', '%'.$request->get('q').'%')
            ->orWhere('guardian_mobile_1', 'like', '%'.$request->get('q').'%')
            ->orWhere('guardian_mobile_2', 'like', '%'.$request->get('q').'%')
            ->orWhere('guardian_email', 'like', '%'.$request->get('q').'%')
            ->get();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function registration()
    {
        $data = [];
        return view(parent::loadDataToView($this->view_path.'.registration.register'), compact('data'));
    }

    public function register(AddValidation $request)
    {
        $parential_image_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR;
        if ($request->hasFile('guardian_main_image')){
            $guardian_image = $request->file('guardian_main_image');
            $guardian_image_name = rand().'_guardian.'.$guardian_image->getClientOriginalExtension();
            $guardian_image->move($parential_image_path, $guardian_image_name);
        }else{
            $guardian_image_name = "";
        }

        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['guardian_image' => $guardian_image_name]);
        $guardian = GuardianDetail::create($request->all());

        $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');

        if($request->add_guardian_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }
    }

    public function view($id)
    {
        $data = [];
        $data['guardian'] = GuardianDetail::select('id', 'guardian_first_name', 'guardian_middle_name', 'guardian_last_name',
            'guardian_eligibility', 'guardian_occupation', 'guardian_office', 'guardian_office_number', 'guardian_residence_number',
            'guardian_mobile_1', 'guardian_mobile_2', 'guardian_email', 'guardian_relation', 'guardian_address','guardian_image',  'status')
            ->where('id',$id)
            ->first();

        //login credential
        $data['guardian_login'] = User::where([['role_id',7],['hook_id',$data['guardian']->id]])->first();

        $data['url'] = URL::current();
        return view(parent::loadDataToView($this->view_path.'.detail.index'), compact('data'));
    }

    public function edit(Request $request, $id)
    {
        $data = [];
        $data['row'] = GuardianDetail::select('id',  'id', 'guardian_first_name', 'guardian_middle_name', 'guardian_last_name',
            'guardian_eligibility', 'guardian_occupation', 'guardian_office', 'guardian_office_number', 'guardian_residence_number',
            'guardian_mobile_1', 'guardian_mobile_2', 'guardian_email', 'guardian_relation', 'guardian_address','guardian_image',  'status')
            ->where('id',$id)
            ->first();

        if (!$data['row'])
            return parent::invalidRequest();

        return view(parent::loadDataToView($this->view_path.'.registration.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        if (!$row = GuardianDetail::find($id))
            return parent::invalidRequest();

        $request->request->add(['updated_by' => auth()->user()->id]);
        $parential_image_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR;

        if ($request->hasFile('guardian_main_image')){
            // remove old image from folder
            if (file_exists($parential_image_path.$row->guardian_image))
                @unlink($parential_image_path.$row->guardian_image);

            $guardian_image = $request->file('guardian_main_image');
            $guardian_image_name = rand().'_guardian.'.$guardian_image->getClientOriginalExtension();
            $guardian_image->move($parential_image_path, $guardian_image_name);
        }

       $guardian_image_name = isset($guardian_image_name)?$guardian_image_name:$row->guardian_image;

        $guardiansInfo = [
            'guardian_first_name'         =>  $request->guardian_first_name,
            'guardian_middle_name'        =>  $request->guardian_middle_name,
            'guardian_last_name'          =>  $request->guardian_last_name,
            'guardian_eligibility'        =>  $request->guardian_eligibility,
            'guardian_occupation'         =>  $request->guardian_occupation,
            'guardian_office'             =>  $request->guardian_office,
            'guardian_office_number'      =>  $request->guardian_office_number,
            'guardian_residence_number'   =>  $request->guardian_residence_number,
            'guardian_mobile_1'           =>  $request->guardian_mobile_1,
            'guardian_mobile_2'           =>  $request->guardian_mobile_2,
            'guardian_email'              =>  $request->guardian_email,
            'guardian_relation'           =>  $request->guardian_relation,
            'guardian_address'            =>  $request->guardian_address,
            'guardian_image'              =>  $guardian_image_name

        ];

        $row->update($guardiansInfo);

        $request->session()->flash($this->message_success, $this->panel. ' Info Updated Successfully.');
        return back();

    }

    public function delete(Request $request, $id)
    {
        if (!$row = GuardianDetail::find($id)) return parent::invalidRequest();

        $parential_image_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR;
        if (file_exists($parential_image_path.$row->guardian_image))
            @unlink($parential_image_path.$row->guardian_image);

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    /*student's info link*/
    public function link(request $request)
    {
        $student = $request->student_link_id;
        $guardian = $request->guardian_id;
        $row = StudentGuardian::where(['students_id' =>$student])->first();

        if ($row){
            $linkData = [
                            'students_id' =>$student,
                            'guardians_id' =>$guardian
                        ];

            $row->update($linkData);
        }else{
            StudentGuardian::create([
                'students_id' =>$student,
                'guardians_id' =>$guardian
            ]);

        };
        $request->session()->flash($this->message_success, 'Student Llink Successfully.');
        return back();
    }

    public function unlink(request $request, $student,$guardian)
    {
        if (!$row = StudentGuardian::where(['students_id' =>$student, 'guardians_id' =>$guardian])->first()) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, 'Student Unlink Successfully.');
        return back();
    }

    public function active(request $request, $id)
    {
        if (!$row = GuardianDetail::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $login_detail = User::where([['role_id',7],['hook_id',$row->id]])->first();
        if($login_detail) {
            $request->request->add(['status' => 'active']);
            $login_detail->update($request->all());
        }

        $request->session()->flash($this->message_success, $row->reg_no.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = GuardianDetail::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);
        $row->update($request->all());

        // in active guardian login detail
        $login_detail = User::where([['role_id',7],['hook_id',$row->id]])->first();
        if($login_detail) {
            $request->request->add(['status' => 'in-active']);
            $login_detail->update($request->all());
        }

        $request->session()->flash($this->message_success, $row->reg_no.' '.$this->panel.' In-Active Successfully.');
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
                            $row = GuardianDetail::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();

                                $login_detail = User::where([['role_id',7],['hook_id',$row->id]])->first();
                                if($login_detail) {
                                    $request->request->add(['status' => $row->status]);
                                    $login_detail->update($request->all());
                                }
                            }
                            break;

                        case 'delete':
                            $row = GuardianDetail::find($row_id);
                            $parential_image_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR;
                            if (file_exists($parential_image_path.$row->guardian_image))
                                @unlink($parential_image_path.$row->guardian_image);

                            $row->delete();

                            $login_detail = User::where([['role_id',7],['hook_id',$row->id]])->first();
                            if($login_detail) {
                                $login_detail->delete();
                            }

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

}
