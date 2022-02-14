<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Hostel;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Day;
use App\Models\EatingTime;
use App\Models\FoodItem;
use App\Models\FoodSchedule;
use App\Models\FoodScheduleItems;
use App\Models\Hostel;
use Illuminate\Http\Request;

class FoodController extends CollegeBaseController
{
    protected $base_route = 'hostel.food';
    protected $view_path = 'hostel.food';
    protected $panel = 'Food Schedule';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['food_schedule'] = FoodSchedule::select('id', 'hostels_id','days_id','eating_times_id', 'status')
            ->orderBy('hostels_id')
            ->orderBy('days_id')
            ->orderBy('eating_times_id')
            ->get();

        /*Hostel List*/
        $hostel = Hostel::select('id','name')->orderBy('name')->get();
        $hostel = array_pluck($hostel,'name','id');
        $data['hostels'] = array_prepend($hostel,'Select Hostel...','0');

        /*Day List*/
        $day = Day::select('id','title')->orderBy('id')->get();
        $day = array_pluck($day,'title','id');
        $data['days'] = array_prepend($day,'Select Day...','0');

        /*Eating Time List*/
        $time = EatingTime::select('id','title')->orderBy('id')->get();

        $time = array_pluck($time,'title','id');
        $data['eating_times'] = array_prepend($time,'Select Time...','0');

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);

        $schedule = FoodSchedule::create($request->all());

        if ($request->has('food_items_id')) {
            $foods = [];
            foreach ($request->get('food_items_id') as $foodItem) {
                $foods[$foodItem] = ([
                    'food_schedule_id' => $schedule->id,
                    'food_item_id' => $foodItem
                ]);
            }

            $schedule->foodItems()->sync($foods);
            $request->session()->flash($this->message_success, $this->panel. ' Successfully.');
        }

       return redirect()->route($this->base_route);
    }

    public function edit(Request $request, $id)
    {
        $data = [];
        if (!$data['row'] = FoodSchedule::find($id))
            return parent::invalidRequest();

        $foods = $data['row']->foodItems()->get();

        $data['html'] = view($this->view_path.'.includes.food_tr_rows', [ 'foods' => $foods ])->render();

        /*detail*/
        $data['food_schedule'] = FoodSchedule::select('id', 'hostels_id','days_id','eating_times_id', 'status')
            ->orderBy('hostels_id')
            ->orderBy('days_id')
            ->orderBy('eating_times_id')
            ->get();

        /*Hostel List*/
        $hostel = Hostel::select('id','name')->orderBy('name')->get();
        $hostel = array_pluck($hostel,'name','id');
        $data['hostels'] = array_prepend($hostel,'Select Hostel...','0');

        /*Day List*/
        $day = Day::select('id','title')->orderBy('id')->get();
        $day = array_pluck($day,'title','id');
        $data['days'] = array_prepend($day,'Select Day...','0');

        /*Eating Time List*/
        $time = EatingTime::select('id','title')->orderBy('id')->get();
        //dd($time);
        $time = array_pluck($time,'title','id');
        $data['eating_times'] = array_prepend($time,'Select Time...','0');

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function update(Request $request, $id)
    {
        if (!$row = FoodSchedule::find($id)) return parent::invalidRequest();

        /*update Schedule*/
        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $row->update($request->all());

        /*update Schedule Foods*/
        $foods = [];
        if($request->has('food_items_id')){
            foreach($request->get('food_items_id') as $foodItem){
                $foods[$foodItem] = [
                    'food_schedule_id' => $id,
                    'food_item_id' => $foodItem
                ];
            }
        }
        $row->foodItems()->sync($foods);

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = FoodSchedule::find($id)) return parent::invalidRequest();

        $row->foodItems()->sync([]);
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
                            $row = FoodSchedule::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = FoodSchedule::find($row_id);
                            $row->foodItems()->sync([]);
                            $row->delete();
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

    public function active(request $request, $id)
    {
        if (!$row = FoodSchedule::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = FoodSchedule::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function foodHtmlRow(Request $request)
    {
        $response = [];
        $response['error'] = true;

        if ($request->has('id')) {
            $foodItem = FoodItem::find($request->get('id'));
            if ($foodItem) {
                $response['error'] = false;
                $response['html'] = view($this->view_path.'.includes.food_tr', [ 'foodItem' => $foodItem ])->render();
                $response['message'] = 'Operation successful.';

            } else{
                $response['message'] = $request->get('subject_id').'Invalid request!!';
            }
        } else{
            $response['message'] = $request->get('subject_id').'Invalid request!!';
        }

        return response()->json(json_encode($response));
    }

    public function foodNameAutocomplete(Request $request)
    {
        if ($request->has('q')) {

            $foods = FoodItem::select('id', 'title','status')
                ->where('title', 'like', '%'.$request->get('q').'%')
                ->get();

            $response = [];
            foreach ($foods as $food) {
                $response[] = ['id' => $food->id, 'text' => $food->title];
            }

            return json_encode($response);
        }

        abort(501);
    }

}