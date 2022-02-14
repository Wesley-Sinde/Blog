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

class StudentMemberController extends CollegeBaseController
{
    protected $base_route = 'library.student';
    protected $view_path = 'library.student';
    protected $panel = 'Library Member Student';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function student(Request $request)
    {
        $data = [];
        $data['lm'] = LibraryMember::select('library_members.id','library_members.user_type', 'library_members.member_id',
            'library_members.status', 'students.first_name',  'students.middle_name',  'students.last_name','students.faculty','students.semester')
            ->where(['library_members.user_type'=> 1 ,'library_members.status' => 1])
            ->where(function ($query) use ($request) {
                $this->commonStudentFilterCondition($query, $request);

            })
            ->join('students','students.id','=','library_members.member_id')
            ->get();

        $circulation = LibraryCirculation::where('user_type','student')->first();
        $filteredMember  = $data['lm']->filter(function ($value, $key) use ($circulation){
            $taken = $value->libBookIssue()->where('status','=',1)->count();
            $eligible = $circulation->issue_limit_books - $taken ;
            $value->taken = $taken;
            $value->eligible = $eligible;
            return $value;
        });

        $data['student'] = $filteredMember;

        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function studentView(Request $request, $id)
    {
        $data = [];
        $data['blank_ins'] = new LibraryMember();
        $data['student'] = LibraryMember::select('library_members.id','library_members.user_type', 'library_members.member_id',
            'library_members.status', 'students.first_name',  'students.middle_name', 'students.last_name',
            'students.last_name', 'students.gender','students.blood_group','students.university_reg','students.date_of_birth','students.nationality',
            'students.mother_tongue','students.email', 'students.faculty','students.semester','students.student_image')
            ->where(['library_members.user_type' =>  1, 'library_members.member_id' =>  $id ])
            ->join('students','students.id','=','library_members.member_id')
            ->first();

        if(!$data['student']) return back()->with($this->message_warning,'Target member is not valid at this time.');

        $data['circulation'] = $data['student']->libCirculation()->first();

        if($data['student'] != null){
            $data['books_taken'] = $data['student']->libBookIssue()->select('book_issues.id', 'book_issues.member_id',
                'book_issues.book_id',  'book_issues.issued_on', 'book_issues.due_date', 'b.book_masters_id',
                'b.book_code', 'bm.title','bm.categories','bm.image')
                ->where('book_issues.status',1)
                ->join('books as b','b.id','=','book_issues.book_id')
                ->join('book_masters as bm','bm.id','=','b.book_masters_id')
                ->orderBy('book_issues.issued_on', 'desc')
                ->get();

            $data['books_history'] = $data['student']->libBookIssue()->select('book_issues.id', 'book_issues.member_id',
                'book_issues.book_id',  'book_issues.issued_on', 'book_issues.due_date','book_issues.return_date', 'b.book_masters_id',
                'b.book_code', 'bm.title','bm.categories','bm.image')
                ->join('books as b','b.id','=','book_issues.book_id')
                ->join('book_masters as bm','bm.id','=','b.book_masters_id')
                ->orderBy('book_issues.issued_on', 'desc')
                ->get();

            $data['book_request'] = BookMaster::select('book_masters.id','book_masters.code', 'book_masters.title', 'book_masters.image',
                'book_masters.categories', 'book_masters.author', 'book_masters.publisher',
                'br.created_at as requested_date')
                ->where('br.member_id',$data['student']->id)
                ->orderBy('book_masters.title','asc')
                ->join('book_requests as br','br.book_masters_id','=','book_masters.id')
                ->get();

        }

        $data['url'] = URL::current();
        return view(parent::loadDataToView($this->view_path.'.detail.index'), compact('data'));
    }

}