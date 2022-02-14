<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodItem extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'foodCategories_id','title','price','image','description','status'];

    public function schedules()
    {
        return $this->belongsToMany(FoodSchedule::class);
    }
}
