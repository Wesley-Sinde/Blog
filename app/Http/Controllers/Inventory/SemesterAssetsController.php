<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Inventory\SemAssets\AddValidation;
use App\Http\Requests\Inventory\SemAssets\EditValidation;
use App\Models\Assets;
use App\Models\Faculty;
use App\Models\SemesterAsset;
use Illuminate\Http\Request;
use URL;

class SemesterAssetsController extends CollegeBaseController
{
    protected $base_route = 'inventory.sem-assets';
    protected $view_path = 'inventory.sem-assets';
    protected $panel = 'Sem./Sec. Assets';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];

        $data['faculties_sem_assets'] = Faculty::Active()
            ->where(function ($query) use ($request) {
                if ($request->get('faculty') > 0) {
                    $query->where('id', '=', $request->faculty);
                    $this->filter_query['id'] = $request->faculty;
                }
            })
            ->orderBy('faculty')->get();

        $data['faculties'] = $this->activeFaculties();
        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];

        $data['faculties'] = $this->activeFaculties();
        $assets = Assets::Active()->orderBy('title')->pluck('title','id')->toArray();
        $data['assets'] = array_prepend($assets,'Select Assets','0');
        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $data = [
                'created_by' => auth()->user()->id,
                'semesters_id' => $request->semester_select,
                'assets_id' => $request->assets,
                'quantity' => $request->quantity,
            ];

        $assets = SemesterAsset::create($data);

        $request->session()->flash($this->message_success, $this->panel. ' Add Successfully.');

        if($request->add_assets_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }

    }

    public function delete(Request $request, $id)
    {
        if (!$row = SemesterAsset::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }



}
