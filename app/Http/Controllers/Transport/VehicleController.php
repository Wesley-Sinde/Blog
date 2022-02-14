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
 * Date: 03/03/2018
 * Time: 7:05 PM
 */
namespace App\Http\Controllers\Transport;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Transport\Vehicle\AddValidation;
use App\Http\Requests\Transport\Vehicle\EditValidation;
use App\Models\Staff;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends CollegeBaseController
{
    protected $base_route = 'transport.vehicle';
    protected $view_path = 'transport.vehicle';
    protected $panel = 'Vehicle';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['vehicle'] = Vehicle::select('id', 'number', 'type', 'model', 'description', 'status')->get();
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);
        $vehicle =  Vehicle::create($request->all());
        if ($request->has('staffs_id')) {
            foreach ($request->get('staffs_id') as $staff) {
                $staffIds = $staff;
                $vehicle->staff()->attach($staffIds);
            }
        }
        $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');
        return redirect()->route($this->base_route);
    }

    public function edit(Request $request, $id)
    {
        $data = [];
        if (!$data['row'] = Vehicle::find($id))
            return parent::invalidRequest();

        $data['html'] = view($this->view_path.'.includes.staff_tr_rows', [
            'staffs' => $data['row']->staff
        ])->render();

        $data['vehicle'] = Vehicle::select('id', 'number', 'type', 'model', 'description', 'status')->orderBy('number')->get();

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {

        if (!$row = Vehicle::find($id)) return parent::invalidRequest();

        $request->request->add(['last_updated_by' => auth()->user()->id]);

        $row->update($request->all());

        if ($request->has('staffs_id')) {
            $staffIds = [];
            foreach ($request->get('staffs_id') as $staff) {
                $staffIds[] = $staff;
            }
            $row->staff()->sync($staffIds);
        }

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Vehicle::find($id)) return parent::invalidRequest();

        $row->staff()->detach();

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
                            $row = Vehicle::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Vehicle::find($row_id);
                            $row->staff()->detach();
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
        if (!$row = Vehicle::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = Vehicle::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function staffHtmlRow(Request $request)
    {
        $response = [];
        $response['error'] = true;

        if ($request->has('id')) {
            $staff = Staff::select('id','first_name',  'middle_name', 'last_name',
                'mobile_1','designation')->find($request->get('id'));
            //$staff = Staff::find($request->get('id'));
            if ($staff) {
                $response['error'] = false;
                $response['html'] = view($this->view_path.'.includes.staff_tr', [ 'staff' => $staff ])->render();
                $response['message'] = 'Operation successful.';

            } else{
                $response['message'] = 'Invalid request!!';
            }
        } else{
            $response['message'] = 'Invalid request!!';
        }

        return response()->json(json_encode($response));
    }

    public function staffAutocomplete(Request $request)
    {
        if ($request->has('q')) {
            $param = $request->get('q');

            $staffs = Staff::select('id', 'first_name',  'middle_name', 'last_name')
                    ->where(function ($query) use($param){
                        $query->where('first_name', 'like', '%'.$param.'%')
                            ->orwhere('middle_name', 'like', '%'.$param.'%')
                            ->orwhere('last_name', 'like', '%'.$param.'%');
                    })
                    ->get();

            $response = [];
            foreach ($staffs as $staff) {
                $response[] = ['id' => $staff->id, 'text' => $staff->first_name.' '.$staff->middle_name.' '.
                                $staff->last_name];
            }

            return json_encode($response);
        }

        abort(501);
    }
}