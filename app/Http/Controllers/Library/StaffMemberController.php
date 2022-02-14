<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Library;

use App\Http\Controllers\CollegeBaseController;
use App\Models\BookMaster;
use App\Models\LibraryCirculation;
use App\Models\LibraryMember;
use Illuminate\Http\Request;
use URL;

class StaffMemberController extends CollegeBaseController
{
    protected $base_route = 'library.staff';
    protected $view_path = 'library.staff';
    protected $panel = 'Library Member Staff';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function staff(Request $request)
    {
        $data = [];
        $data['lm'] = LibraryMember::select('library_members.id','library_members.user_type',
            'library_members.member_id', 'library_members.status', 'staff.reg_no','staff.first_name',  'staff.middle_name',  'staff.last_name','staff.designation')
            ->where(['library_members.user_type'=> 2 ,'library_members.status' => 1])
            ->where(function ($query) use ($request) {
                $this->commonStaffFilterCondition($query, $request);
            })
            ->join('staff','staff.id','=','library_members.member_id')
            ->get();

        $circulation = LibraryCirculation::where('user_type','staff')->first();
        $filteredMember  = $data['lm']->filter(function ($value, $key) use ($circulation){
            $taken = $value->libBookIssue()->where('status','=',1)->count();
            $eligible = $circulation->issue_limit_books - $taken ;
            $value->taken = $taken;
            $value->eligible = $eligible;
            return $value;
        });

        $data['staff'] = $filteredMember;

        $data['designation'] = $this->staffDesignationList();
        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function staffView(Request $request, $id)
    {
        $data = [];
        $data['blank_ins'] = new LibraryMember();
        $data['staff'] = LibraryMember::select('library_members.id','library_members.user_type',
            'library_members.member_id', 'library_members.status', 'staff.id as staffId','staff.first_name',  'staff.middle_name', 'staff.last_name',
            'staff.last_name', 'staff.gender','staff.blood_group','staff.home_phone', 'staff.mobile_1','staff.nationality','staff.email', 'staff.staff_image')
            ->where(['library_members.user_type' =>  2, 'library_members.member_id' =>  $id ])
            ->join('staff','staff.id','=','library_members.member_id')
            ->first();

        if(!$data['staff']) return back()->with($this->message_warning,'Target member is not valid at this time.');

        $data['circulation'] = $data['staff']->libCirculation()->first();

        if($data['staff'] != null){
            $data['books_taken'] = $data['staff']->libBookIssue()->select('book_issues.id', 'book_issues.member_id',
                'book_issues.book_id',  'book_issues.issued_on', 'book_issues.due_date', 'b.book_masters_id',
                'b.book_code', 'bm.title','bm.categories','bm.image')
                ->where('book_issues.status',1)
                ->join('books as b','b.id','=','book_issues.book_id')
                ->join('book_masters as bm','bm.id','=','b.book_masters_id')
                ->orderBy('book_issues.issued_on', 'desc')
                ->get();

            $data['books_history'] = $data['staff']->libBookIssue()->select('book_issues.id', 'book_issues.member_id',
                'book_issues.book_id',  'book_issues.issued_on', 'book_issues.due_date','book_issues.return_date', 'b.book_masters_id',
                'b.book_code', 'bm.title','bm.categories','bm.image')
                ->join('books as b','b.id','=','book_issues.book_id')
                ->join('book_masters as bm','bm.id','=','b.book_masters_id')
                ->orderBy('book_issues.issued_on', 'desc')
                ->get();

            $data['book_request'] = BookMaster::select('book_masters.id','book_masters.code', 'book_masters.title', 'book_masters.image',
                'book_masters.categories', 'book_masters.author', 'book_masters.publisher',
                'br.created_at as requested_date')
                ->where('br.member_id',$data['staff']->id)
                ->orderBy('book_masters.title','asc')
                ->join('book_requests as br','br.book_masters_id','=','book_masters.id')
                ->get();
        }

        $data['url'] = URL::current();
        return view(parent::loadDataToView($this->view_path.'.detail.index'), compact('data'));
    }

}