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
use App\Http\Requests\Certificate\Transfer\AddValidation;
use App\Http\Requests\Certificate\Transfer\EditValidation;
use App\Models\CertificateTemplate;
use App\Models\TransferCertificate;
use App\Models\CertificateHistory;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use URL;
use ViewHelper;
class TransferCertificateController extends CollegeBaseController
{
    protected $base_route = 'certificate.transfer';
    protected $view_path = 'certificate.transfer';
    protected $panel = 'Transfer Certificate';
    protected $folder_path;
    protected $codePrefix = "A";
    protected $codeStart = 00000;
    protected $filter_query = [];

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $data = [];

        $data['student'] = Student::select('students.id','students.reg_no', 'students.reg_date',
            'students.faculty', 'students.semester', 'students.batch', 'students.academic_status', 'students.first_name',
            'students.middle_name', 'students.last_name', 'tc.id as certificate_id','tc.date_of_issue', 'tc.date_of_leaving',
            'tc.tc_num', 'tc.leaving_time_class', 'tc.qualified_to_promote','tc.paid_fee_status','tc.character','tc.ref_text')
            ->where(function ($query) use ($request) {

                $this->commonStudentFilterCondition($query, $request);

                if ($request->has('issue-start-date') && $request->has('issue-end-date')) {
                    $query->whereBetween('tc.date_of_issue', [$request->get('issue-start-date'), $request->get('issue-end-date')]);
                    $this->filter_query['issue-start-date'] = $request->get('issue-start-date');
                    $this->filter_query['issue-end-date'] = $request->get('issue-end-date');
                } elseif ($request->has('issue-start-date')) {
                    $query->where('tc.date_of_issue', '>=', $request->get('issue-start-date'));
                    $this->filter_query['issue-start-date'] = $request->get('issue-start-date');
                } elseif ($request->has('issue-end-date')) {
                    $query->where('tc.date_of_issue', '<=', $request->get('issue-end-date'));
                    $this->filter_query['issue-end-date'] = $request->get('issue-end-date');
                }

                if ($request->has('leave-start-date') && $request->has('leave-end-date')) {
                    $query->whereBetween('tc.date_of_leaving', [$request->get('leave-start-date'), $request->get('leave-end-date')]);
                    $this->filter_query['leave-start-date'] = $request->get('leave-start-date');
                    $this->filter_query['leave-end-date'] = $request->get('leave-end-date');
                } elseif ($request->has('leave-start-date')) {
                    $query->where('tc.date_of_leaving', '>=', $request->get('leave-start-date'));
                    $this->filter_query['leave-start-date'] = $request->get('leave-start-date');
                } elseif ($request->has('leave-end-date')) {
                    $query->where('tc.date_of_leaving', '<=', $request->get('leave-end-date'));
                    $this->filter_query['leave-end-date'] = $request->get('leave-end-date');
                }

                if ($request->has('tc_num')) {
                    $query->where('tc.tc_num', 'like', '%'. $request->tc_num.'%');
                    $this->filter_query['tc.tc_num'] = $request->tc_num;
                }

                if ($request->has('character')) {
                    $query->where('tc.character', 'like', '%'. $request->character.'%');
                    $this->filter_query['tc.character'] = $request->character;
                }

                if ($request->has('paid_fee_status')) {
                    $query->where('tc.paid_fee_status', 'like', '%'. $request->paid_fee_status.'%');
                    $this->filter_query['tc.paid_fee_status'] = $request->paid_fee_status;
                }

                if ($request->has('qualified_to_promote')) {
                    $query->where('tc.qualified_to_promote', 'like', '%'. $request->qualified_to_promote.'%');
                    $this->filter_query['tc.qualified_to_promote'] = $request->qualified_to_promote;
                }

                if ($request->has('leaving_time_class')) {
                    $query->where('tc.leaving_time_class', 'like', '%'. $request->leaving_time_class.'%');
                    $this->filter_query['tc.leaving_time_class'] = $request->leaving_time_class;
                }

            })
            ->join('transfer_certificates as tc', 'tc.students_id', '=', 'students.id')
            ->get();


        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();


        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request, $id)
    {
        $id = decrypt($id);
        $data['row'] = Student::find($id);
        $data['faculties'] = $this->activeFaculties();
        $data['semester'] = $this->activeSemester();
        $data['batch'] = $this->activeBatch();
        $tcInfo = TransferCertificate::latest()->first();
        if($tcInfo){
            $num = $tcInfo->tc_num;
            $numbers = intval(preg_replace('/[^0-9]/', '', $num))+1;
            $numbers = str_pad($numbers, 5, '0', STR_PAD_LEFT);
            $letters = preg_replace('/[^a-zA-Z]/', '', $num);
            $data['tc_num'] = $this->codePrefix.$numbers;
        }else{
            $numbers = intval($this->codeStart)+1;
            $numbers = str_pad($numbers, 5, '0', STR_PAD_LEFT);
            $data['tc_num'] = $this->codePrefix.$numbers;
        }

        $data['url'] = URL::current();

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['date_of_issue' => Carbon::parse($request->issue_date)]);
        $request->request->add(['date_of_leaving' => Carbon::parse($request->date_of_leaving)]);
        $request->request->add(['ref_text' => json_encode($request->except('_token'))]);

        $row = TransferCertificate::create($request->all());

        if($row){
            $CreateHistory = CertificateHistory::create([
                'students_id' => $row->students_id,
                'certificate' => 'transfer',
                'certificate_id' => $row->id,
                'history_type' => 'Created',
                'ref_text' => json_encode($request->except('ref_text','_token')),
                'created_by' => auth()->user()->id,
            ]);
        }

        $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');
        return redirect()->route($this->base_route);

    }

    public function edit(Request $request, $id)
    {
        $data = [];
        $data['row'] = Student::select('students.id','students.reg_no', 'students.reg_date',
            'students.faculty', 'students.semester', 'students.batch', 'students.academic_status', 'students.first_name',
            'students.middle_name', 'students.last_name', 'tc.id as certificate_id','tc.tc_num','tc.date_of_issue', 'tc.date_of_leaving',
            'tc.tc_num', 'tc.leaving_time_class', 'tc.qualified_to_promote','tc.paid_fee_status','tc.character')
            ->join('transfer_certificates as tc', 'tc.students_id', '=', 'students.id')
            ->find($id);

          if (!$data['row'])
            return parent::invalidRequest();

        $data['faculties'] = $this->activeFaculties();
        $data['semester'] = $this->activeSemester();
        $data['batch'] = $this->activeBatch();

        $data['url'] = URL::current();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        if (!$student = Student::find($request->students_id)) return parent::invalidRequest();

        $updateData = [
            "tc_num" => $request->tc_num,
            "date_of_issue" => Carbon::parse($request->date_of_issue),
            "date_of_leaving" => Carbon::parse($request->date_of_leaving),
            "character" => $request->character,
            "leaving_time_class" => $request->leaving_time_class,
            "paid_fee_status" => $request->paid_fee_status,
            "qualified_to_promote" => $request->qualified_to_promote,
            "ref_text" => json_encode($request->except('_token')),
            "last_updated_by" => auth()->user()->id,
        ];


        $row = $student->transferCertificate()->update($updateData);

        if($row){
            //manage history
            $CreateHistory = CertificateHistory::create([
                'students_id' => $student->id,
                'certificate' => 'transfer',
                'certificate_id' => $student->transferCertificate()->first()->id,
                'history_type' => 'Updated',
                'ref_text' => json_encode($request->except('ref_text','_token')),
                'created_by' => auth()->user()->id,
            ]);
        }

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function view(Request $request, $id)
    {
        $data['student'] = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
            'students.faculty','students.semester','students.batch', 'students.academic_status', 'students.first_name', 'students.middle_name',
            'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group',  'students.religion', 'students.caste','students.nationality',
            'students.mother_tongue','students.student_image', 'pd.father_first_name', 'pd.father_middle_name', 'pd.father_last_name',
            'tc.id as certificate_id','tc.date_of_issue', 'tc.date_of_leaving', 'tc.tc_num', 'tc.leaving_time_class',
            'tc.qualified_to_promote','tc.paid_fee_status','tc.character','tc.ref_text')
            ->where('students.id',$id)
            ->join('transfer_certificates as tc', 'tc.students_id', '=', 'students.id')
            ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
            ->get();

        if (!$data['student'])
            return parent::invalidRequest();

        return view(parent::loadDataToView($this->view_path.'.view'), compact('data'));

    }

    public function delete(Request $request, $id)
    {
        if (!$row = Student::find($id)) return parent::invalidRequest();
        $certificate = $row->transferCertificate()->first();
        //delete history
        CertificateHistory::where('certificate_id','=',$certificate->id)->delete();
        //delete certificate
        $certificate->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['print','active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    $row = TransferCertificate::find($row_id);
                    switch ($request->get('bulk_action')) {
                        case 'print':
                            $data['student'] = $this->bulkPrint($request->get('stuIds'));
                            return view(parent::loadDataToView('print.certificate.transfer'), compact('data'));
                            break;
                        case 'active':
                        case 'in-active':
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            //delete history
                            CertificateHistory::where('certificate_id','=',$row->id)->delete();
                            //delete certificate
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

    public function print($id)
    {
        $id = decrypt($id);
        $data['student'] = $this->bulkPrint([$id]);

        if (!$data['student'])
            return parent::invalidRequest();

        $data['certificate_template'] = CertificateTemplate::where('certificate','=','TRANSFER')
            ->first();

        return view(parent::loadDataToView('print.certificate.transfer'), compact('data'));
    }

    public function bulkPrint($studIds)
    {
        $students = Student::select('id')->whereIn('id',$studIds)->get();
        $certificateTemplate = CertificateTemplate::where('certificate','TRANSFER')->first();

        $filteredStudent = $students->filter(function ($student, $key) use($certificateTemplate) {
            $data = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
                'students.faculty','students.semester','students.batch', 'students.academic_status', 'students.first_name', 'students.middle_name',
                'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group',  'students.religion',
                'students.caste','students.nationality', 'students.mother_tongue', 'students.email', 'students.extra_info',
                'students.status',
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
                'students.student_image','students.student_signature', 'pd.father_image', 'pd.mother_image', 'gd.guardian_image',
                'tc.date_of_issue', 'tc.date_of_leaving', 'tc.tc_num', 'tc.leaving_time_class', 'tc.qualified_to_promote',
                'tc.paid_fee_status','tc.character','tc.ref_text')
                ->where('students.id','=',$student->id)
                ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
                ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                ->join('student_guardians as sg', 'sg.students_id','=','students.id')
                ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
                ->join('transfer_certificates as tc', 'tc.students_id', '=', 'students.id')
                ->first();


            $student->date_of_issue = $data->date_of_issue;
            $student->tc_num = $data->tc_num;
            $student->faculty = $data->faculty;
            $student->reg_no = $data->reg_no;
            $student->university_reg = $data->university_reg;
            $student->certificate = $certificateTemplate->certificate;

            $text = str_replace('{{date_of_leaving}}', Carbon::parse($data->date_of_leaving)->format('d-m-Y'), $certificateTemplate->template);
            $text = str_replace('{{character}}', $data->character, $text);
            $text = str_replace('{{tc_num}}', $data->tc_num, $text);
            $text = str_replace('{{leaving_time_class}}', $data->leaving_time_class, $text);
            $text = str_replace('{{qualified_to_promote}}', $data->qualified_to_promote, $text);
            $text = str_replace('{{paid_fee_status}}', $data->paid_fee_status, $text);

            if($certificateTemplate->student_photo == 1){
                $student->student_image = $data->student_image?$data->student_image:"";
                $imageUrl=url('images/studentProfile').'/'.$student->student_image;
                $image = "<img class=\"img-thumbnail\" alt=\"\" src=\"$imageUrl\" width=\"150px\" />";

                $text = str_replace('{{student_image}}', $image, $text);
            }else{
                $text = str_replace('{{student_image}}', '', $text);
            }

            $certificateTemplate = $this->textReplace($data, $text);
            $student->certificate_template = $certificateTemplate;

            return $student;
        });

        return $data['students'] = $filteredStudent;

    }


    /*public function dateToWord($date)
    {
        $th = array(
            1 => "first", 2 => "second", 3 => "third", 4 => "fourth", 5 => "fifth", 6 => "sixth",
            7 => "seventh", 8 => "eighth", 9 => "nineth", 10 => "tenth", 11 => "eleventh", 12 => "twelfth", 13 => "thirteenth", 14 => "fourteenth", 15 => "fifteenth", 16 => "sixteenth", 17 => "seventeenth", 18 => "eighteenth", 19 => "nineteenth", 20 => "twentyth"
        );

        $ones = array(
            1 => "one", 2 => "two", 3 => "three", 4 => "four", 5 => "five", 6 => "six",
            7 => "seven", 8 => "eight", 9 => "nine", 10 => "ten", 11 => "eleven", 12 => "twelve", 13 => "thirteen",
            14 => "fourteen", 15 => "fifteen", 16 => "sixteen", 17 => "seventeen", 18 => "eighteen", 19 => "nineteen"
        );

        $tens = array(
            1 => "ten",2 => "twenty", 3 => "thirty", 4 => "forty", 5 => "fifty",
            6 => "sixty", 7 => "seventy", 8 => "eighty", 9 => "ninety"
        );

        //$dateString = "04-01-1965";
        //dd($date);//"01-05-2020"
        $dateString = $date;

        $day = date("j", strtotime($dateString));
        if ($day <= 20) $day = $th[$day];
        if($day > 20 ){
            $day = strval($day);
            $second = intval($day[1]);
            $str1 = $tens[intval($day[0])];
            $str2 = $th[intval($day[1])];
            $day = $str1." ".$str2;
        }

        $month = date("F", strtotime($dateString));
        $year = strval(date("Y", strtotime($dateString)));

        $first_half = intval($year[0].$year[1]);
        if($first_half < 20 ) $first_half = $ones[$first_half];
        if($first_half >= 20) {
            $first_half = $tens[$year[0]]." ".$ones[$year[1]];
        }

        $second_half = intval($year[2].$year[3]);
        if($second_half < 20 ) $second_half = $ones[$second_half];
        if($second_half >= 20) {
            $second_half = $tens[$year[2]]." ".$ones[$year[3]];
        }

        $years = $first_half." ".$second_half;
        echo "Today is " . $day." ".strtolower($month)." ".$years."<br>";

    }*/

}

