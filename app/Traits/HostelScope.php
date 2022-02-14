<?php
namespace App\Traits;

use App\Models\Bed;
use App\Models\BedStatus;
use App\Models\EatingTime;
use App\Models\FoodCategory;
use App\Models\FoodItem;
use App\Models\Hostel;
use App\Models\Room;
use App\Models\RoomType;

trait HostelScope{

    public function getHostelNameById($id)
    {
        $hostel = Hostel::find($id);
        if ($hostel) {
            return $hostel->name;
        }else{
            return "Unknown";
        }
    }


    public function getRoomTypeTitleById($id)
    {
        $roomType = RoomType::find($id);
        if ($roomType) {
            return $roomType->title;
        }else{
            return "Unknown";
        }
    }

    public function getRoomNumberById($id)
    {
        $room = Room::find($id);
        if ($room) {
            return $room->room_number;
        }else{
            return "Unknown";
        }
    }

    public function getBedNumberById($id)
    {
        $bed = Bed::find($id);
        if ($bed) {
            return $bed->bed_number;
        }else{
            return "Unknown";
        }
    }

    public function getBedStatusById($id)
    {
        $bedStatus = BedStatus::find($id);
        if ($bedStatus) {
            return $bedStatus->title;
        }else{
            return "Unknown";
        }
    }

    public function getBedStatusClassById($id)
    {
        $BedStatus = BedStatus::find($id);
        if ($BedStatus) {
            return $BedStatus->display_class;
        }else{
            return "Unknown";
        }
    }

    public function getFoodCategoryById($id){
        $foodCategory = FoodCategory::find($id);
        if($foodCategory){
            return $foodCategory->title;
        }else{
            return "Unknown";
        }
    }

    public function getFoodTimeById($id){
        $eatingTime = EatingTime::find($id);
        if($eatingTime){
            return $eatingTime->title;
        }else{
            return "Unknown";
        }
    }

    public function getFoodItemById($id){
        $foodItem = FoodItem::find($id);
        if($foodItem){
            return $foodItem->title;
        }else{
            return "Unknown";
        }
    }


    public function activeHostel()
    {
        $hostels = Hostel::select('id','name')->Active()->pluck('name','id')->toArray();
        return array_prepend($hostels,'Select Hostel...','0');
    }
}