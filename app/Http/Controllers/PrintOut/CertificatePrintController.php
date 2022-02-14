<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\PrintOut;

use App\Http\Controllers\CollegeBaseController;
use App\Models\CertificateTemplate;
use App\Models\ExamSchedule;
use App\Models\Semester;
use App\Models\Student;
use App\Traits\StudentScopes;
use Illuminate\Http\Request;
use view, URL;
use ViewHelper;
class CertificatePrintController extends CollegeBaseController
{
    protected $base_route = 'print.certificate';
    protected $view_path = 'print.certificate';
    protected $panel = 'Certificate Printing';
    protected $filter_query = [];

    use StudentScopes;

    public function __construct()
    {

    }

     public function generalCertificate(Request $request)
    {
        /*$studIds = $request->get('chkIds');
        $students = Student::select('id')->whereIn('id',$studIds)->get();
        $certificateTemplate = CertificateTemplate::find($request->certificate);

        $filteredStudent = $students->filter(function ($student, $key) use($certificateTemplate) {
            $data = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
                'students.faculty','students.semester', 'students.academic_status', 'students.first_name', 'students.middle_name',
                'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group',  'students.religion', 'students.caste','students.nationality',
                'students.mother_tongue', 'students.email', 'students.extra_info', 'students.status',
                'ai.address', 'ai.state', 'ai.country', 'ai.temp_address', 'ai.temp_state', 'ai.temp_country', 'ai.home_phone',
                'ai.mobile_1', 'ai.mobile_2',
                'pd.grandfather_first_name',
                'pd.grandfather_middle_name', 'pd.grandfather_last_name', 'pd.father_first_name', 'pd.father_middle_name',
                'pd.father_last_name', 'pd.father_eligibility', 'pd.father_occupation', 'pd.father_office', 'pd.father_office_number',
                'pd.father_residence_number', 'pd.father_mobile_1', 'pd.father_mobile_2', 'pd.father_email', 'pd.mother_first_name',
                'pd.mother_middle_name', 'pd.mother_last_name', 'pd.mother_eligibility', 'pd.mother_occupation', 'pd.mother_office',
                'pd.mother_office_number', 'pd.mother_residence_number', 'pd.mother_mobile_1', 'pd.mother_mobile_2', 'pd.mother_email',
                'gd.id as guardian_id', 'gd.guardian_first_name', 'gd.guardian_middle_name', 'gd.guardian_last_name',
                'gd.guardian_eligibility', 'gd.guardian_occupation', 'gd.guardian_office', 'gd.guardian_office_number', 'gd.guardian_residence_number',
                'gd.guardian_mobile_1', 'gd.guardian_mobile_2', 'gd.guardian_email', 'gd.guardian_relation', 'gd.guardian_address',
                'students.student_image','students.student_signature', 'pd.father_image', 'pd.mother_image', 'gd.guardian_image')
                ->where('students.id','=',$student->id)
                ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
                ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                ->join('student_guardians as sg', 'sg.students_id','=','students.id')
                ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
                ->first();

            if($certificateTemplate->student_photo == 1 && $data->student_image){
                $student->student_image = $data->student_image;
            }else{
                $student->student_image = "";
            }

            $student->certificate = $certificateTemplate->certificate;
            $certificateTemplate = $this->textReplace($data, $certificateTemplate->template);
            $student->certificate_template = $certificateTemplate;

            return $student;*/

        $studIds = $request->get('chkIds');

        $students = Student::select('id')->whereIn('id',$studIds)->get();
        $certificateTemplate = CertificateTemplate::find($request->certificate);

        $filteredStudent = $students->filter(function ($student, $key) use($certificateTemplate) {
            $data = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
                'students.faculty','students.semester', 'students.academic_status', 'students.first_name', 'students.middle_name',
                'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group',  'students.religion',
                'students.caste','students.nationality',
                'students.mother_tongue', 'students.email', 'students.extra_info', 'students.status',
                'ai.address', 'ai.state', 'ai.country', 'ai.temp_address', 'ai.temp_state', 'ai.temp_country', 'ai.home_phone',
                'ai.mobile_1', 'ai.mobile_2', 'pd.grandfather_first_name',
                'pd.grandfather_middle_name', 'pd.grandfather_last_name', 'pd.father_first_name', 'pd.father_middle_name',
                'pd.father_last_name', 'pd.father_eligibility', 'pd.father_occupation', 'pd.father_office', 'pd.father_office_number',
                'pd.father_residence_number', 'pd.father_mobile_1', 'pd.father_mobile_2', 'pd.father_email', 'pd.mother_first_name',
                'pd.mother_middle_name', 'pd.mother_last_name', 'pd.mother_eligibility', 'pd.mother_occupation', 'pd.mother_office',
                'pd.mother_office_number', 'pd.mother_residence_number', 'pd.mother_mobile_1', 'pd.mother_mobile_2', 'pd.mother_email',
                'gd.id as guardian_id', 'gd.guardian_first_name', 'gd.guardian_middle_name', 'gd.guardian_last_name',
                'gd.guardian_eligibility', 'gd.guardian_occupation', 'gd.guardian_office', 'gd.guardian_office_number', 'gd.guardian_residence_number',
                'gd.guardian_mobile_1', 'gd.guardian_mobile_2', 'gd.guardian_email', 'gd.guardian_relation', 'gd.guardian_address',
                'students.student_image','students.student_signature', 'pd.father_image', 'pd.mother_image', 'gd.guardian_image')
                ->where('students.id','=',$student->id)
                ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
                ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                ->join('student_guardians as sg', 'sg.students_id','=','students.id')
                ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
                ->first();

            if($certificateTemplate->student_photo == 1){
                $student->student_image = $data->student_image?$data->student_image:"";
            }

            $student->certificate = $certificateTemplate->certificate;
            $certificateTemplate = $this->textReplace($data, $certificateTemplate->template);
            $student->certificate_template = $certificateTemplate;

            return $student;
        });

        $data['students'] = $filteredStudent;

        /*$data['certificate_template'] = CertificateTemplate::where('certificate','=','GENERAL TEMPLATE')
            ->first();
        return view(parent::loadDataToView($this->view_path.'.generate'), compact('data'));*/

        $data['certificate_template'] = CertificateTemplate::find($request->certificate);

        if($data['certificate_template']->certificate == 'IDENTITY CARD'){
            return view(parent::loadDataToView($this->view_path.'.identity-card'), compact('data'));
        }else{
            return view(parent::loadDataToView($this->view_path.'.generate'), compact('data'));
        }


        /*where('','=',)
            ->first();*/


    }



}

