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
use App\Models\BedStatus;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends CollegeBaseController
{
    protected $base_route = 'hostel.room';
    protected $view_path = 'hostel.room';
    protected $panel = 'Room';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function add(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');

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
                $row = Room::where('room_number','=',$start)->first();
                if($row){
                    $request->session()->flash($this->message_warning, $this->panel. ' Room Already Exist Please Correct and Try Again.');
                }else{
                    Room::create([
                        'hostels_id' => $request->get('hostelId'),
                        'room_number' => $start,
                        'room_type' => $request->get('room_type'),
                        'rate_perbed' => $request->get('rate_perbed'),
                        'created_by' => auth()->user()->id,
                    ]);
                }
                $start++;
                $i++;
            }
        }
        $request->session()->flash($this->message_success, $this->panel. ' Add on Hostel Successfully.');
        return back();

    }

    public function bulkAction(Request $request)
    {

        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    switch ($request->get('bulk_action')) {
                        case 'active':
                        case 'in-active':
                            $row = Room::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Room::find($row_id);
                            $row->delete();
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, $request->get('bulk_action'). ' Action Successfully.');
                else
                    $request->session()->flash($this->message_success, 'Deleted successfully.');

                return redirect()->back();

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->back();
            }

        } else return parent::invalidRequest();




    }

    public function update(Request $request)
    {
        $hostelId = $request->get('hostelId');
        $roomId = $request->get('roomId');
        $room_number = $request->get('room_number');
        $room_type = $request->get('room_type');
        $rate_perbed = $request->get('rate_perbed');
        if (!$row = Room::where(['id'=>$roomId])->first()) return parent::invalidRequest();

        $request->request->add(['last_updated_by' => auth()->user()->id]);

        $row->update([
            'hostels_id' => $hostelId,
            'room_number' => $room_number,
            'room_type' => $room_type,
            'rate_perbed' => $rate_perbed,
            'created_by' => auth()->user()->id,
        ]);

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return back();
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Room::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, ' Room Deleted Successfully.');
        return redirect()->back();
    }

    public function Active(request $request, $id)
    {
        if (!$row = Room::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, ' Room Active Successfully.');
        return redirect()->back();
    }

    public function InActive(request $request, $id)
    {
        if (!$row = Room::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success,' Room In-Active Successfully.');
        return redirect()->back();
    }

    public function view(Request $request, $id)
    {
        $data = [];
        $data['rooms'] = Room::select('id', 'hostels_id','room_type','room_number', 'rate_perbed', 'description', 'status')
            ->where('id','=',$id)
            ->orderBy('room_number','asc')
            ->first();

        $data['beds'] = Bed::where('rooms_id','=',$data['rooms']->id )
            ->get();

        $data['beds_status'] = BedStatus::select('id', 'title', 'display_class')->get();

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

}