<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Report;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Staff;
use App\Models\StaffDesignation;
use Illuminate\Http\Request;
use Image, URL;
use ViewHelper;

class StaffReportController extends CollegeBaseController
{
    protected $base_route = 'report.staff';
    protected $view_path = 'report.staff';
    protected $panel = 'Staff Report';
    protected $filter_query = [];


    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $data = [];
        $data['staff'] = Staff::select('id','reg_no', 'join_date', 'designation', 'first_name',  'middle_name', 'last_name',
            'father_name', 'mother_name', 'date_of_birth', 'gender', 'blood_group', 'nationality','mother_tongue', 'address', 'state', 'country',
            'temp_address', 'temp_state', 'temp_country', 'home_phone', 'mobile_1', 'mobile_2', 'email', 'qualification',
            'experience', 'experience_info', 'other_info','status')
            ->where(function ($query) use ($request) {
                $this->commonStaffFilterCondition($query, $request);
            })
            ->get();

        $data['designation'] = $this->staffDesignationList();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function staffDesignationList()
    {
        /*get designation*/
        $designation = StaffDesignation::select('id','title')->orderBy('title')->get();
        $designation = array_pluck($designation,'title','id');
        $designation = array_prepend($designation,'Select Designation...','0');

        /*designation represent as list*/
        return $designation;
    }

}
