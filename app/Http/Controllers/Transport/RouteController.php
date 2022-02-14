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
use App\Http\Requests\Transport\Route\AddValidation;
use App\Http\Requests\Transport\Route\EditValidation;
use App\Models\Route;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class RouteController extends CollegeBaseController
{
    protected $base_route = 'transport.route';
    protected $view_path = 'transport.route';
    protected $panel = 'Route';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['route'] = Route::select('id', 'title', 'rent', 'description', 'status')->get();
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);
        $route =  Route::create($request->all());

        if ($request->has('vehicles_id')) {
            foreach ($request->get('vehicles_id') as $vehicle) {
                $vehicleIds = $vehicle;
                $route->vehicle()->attach($vehicleIds);
            }
        }

        $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');
        return redirect()->route($this->base_route);
    }

    public function edit(Request $request, $id)
    {
        $data = [];
        if (!$data['row'] = Route::find($id))
            return parent::invalidRequest();

        $data['html'] = view($this->view_path.'.includes.vehicle_tr_rows', [
            'vehicles' => $data['row']->vehicle
        ])->render();

        $data['route'] = Route::select('id', 'title', 'rent', 'description', 'status')->orderBy('title')->get();

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        if (!$row = Route::find($id)) return parent::invalidRequest();

        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $row->update($request->all());

        if ($request->has('vehicles_id')) {
            $vehicleIds = [];
            foreach ($request->get('vehicles_id') as $vehicle) {
                $vehicleIds[] = $vehicle;
            }

            $row->vehicle()->sync($vehicleIds);
        }


        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Route::find($id)) return parent::invalidRequest();

        $row->vehicle()->detach();

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
                            $row = Route::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Route::find($row_id);
                            $row->vehicle()->detach();
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
        if (!$row = Route::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = Route::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function vehicleHtmlRow(Request $request)
    {
        $response = [];
        $response['error'] = true;

        if ($request->has('id')) {
            $vehicle = Vehicle::select('id','number', 'type', 'model')->find($request->get('id'));
            if ($vehicle) {
                $response['error'] = false;
                $response['html'] = view($this->view_path.'.includes.vehicle_tr', [ 'vehicle' => $vehicle ])->render();
                $response['message'] = 'Operation successful.';

            } else{
                $response['message'] = 'Invalid request!!';
            }
        } else{
            $response['message'] = 'Invalid request!!';
        }

        return response()->json(json_encode($response));
    }

    public function vehicleAutocomplete(Request $request)
    {
        if ($request->has('q')) {
            $param = $request->get('q');

            $vehicles = Vehicle::select('id','number', 'type', 'model')
                ->where(function ($query) use($param){
                    $query->where('number', 'like', '%'.$param.'%')
                        ->orwhere('type', 'like', '%'.$param.'%')
                        ->orwhere('model', 'like', '%'.$param.'%');
                })
                ->get();

            $response = [];
            foreach ($vehicles as $vehicle) {
                $response[] = ['id' => $vehicle->id, 'text' => $vehicle->number.' | '.$vehicle->model .' | '.$vehicle->type];
            }

            return json_encode($response);
        }

        abort(501);
    }
}