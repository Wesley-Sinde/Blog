<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodSchedule extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'hostels_id', 'days_id', 'eating_times_id','status'];

    public function foodItems()
    {
        return $this->belongsToMany(FoodItem::class,'food_item_food_schedule','food_schedule_id');
    }
}
