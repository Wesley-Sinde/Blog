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
namespace App\Http\Controllers\Hostel;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Bed;
use Illuminate\Http\Request;

class BedController extends CollegeBaseController
{
    protected $base_route = 'hostel.bed';
    protected $view_path = 'hostel.bed';
    protected $panel = 'Bed';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function addBeds(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');
        $hostelId = $request->get('hostelId');
        $roomId = $request->get('roomId');

        if($start == 0 or $end == 0){
            $request->session()->flash($this->message_warning, $this->panel. ' Attention!, Please Enter Start Value Greater Than 0');
            return back();
        }

        if($start > $end){
            $request->session()->flash($this->message_warning, $this->panel. ' Attention!, Yo have enter End Value is Less than Start. Correct It.');
            return back();
        }

        if($start == $end){
            $rooms = 1;
        }else{
            $rooms = ($end - $start) + 1;
        }

        if ($rooms > 0) {
            $i = 1;
            while ($i <= $rooms){
                $row = Bed::where([['hostels_id','=',$hostelId],['rooms_id','=',$roomId],['bed_number','=',$start]])->first();
                if($row){
                    $request->session()->flash($this->message_warning, $this->panel. ' Already Exist Please Correct and Try Again.');
                    return back();
                }else{
                    Bed::create([
                        'hostels_id' => $hostelId,
                        'rooms_id' => $roomId,
                        'bed_number' => $start,
                        'created_by' => auth()->user()->id,
                    ]);
                }
                $start++;
                $i++;
            }
        }
        $request->session()->flash($this->message_success, $this->panel.' Add Successfully.');
        return back();
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Bed::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->back();
    }

    public function Active(request $request, $id)
    {
        if (!$row = Bed::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.'  Active Successfully.');
        return redirect()->back();
    }

    public function InActive(request $request, $id)
    {
        if (!$row = Bed::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success,$this->panel.' In-Active Successfully.');
        return redirect()->back();
    }


    public function bulkAction(Request $request)
    {

        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    switch ($request->get('bulk_action')) {
                        case 'active':
                        case 'in-active':
                            $row = Bed::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Bed::find($row_id);
                            $row->delete();
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, $request->get('bulk_action'). ' Action Successfully.');
                else
                    $request->session()->flash($this->message_success, $this->panel . ' Deleted successfully.');

                return redirect()->back();

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->back();
            }

        } else return parent::invalidRequest();




    }

    public function bedStatus(request $request, $id, $status)
    {
        if (!$row = Bed::find($id)) return parent::invalidRequest();

        $request->request->add(['bed_status' => $status]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Status Change Successfully.');
        return back();
    }


}