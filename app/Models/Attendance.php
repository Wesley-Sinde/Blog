<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'attendees_type', 'link_id', 'years_id','months_id',
        'day_1','day_2','day_3','day_4','day_5','day_6','day_7','day_8','day_9','day_10','day_11','day_12','day_13',
        'day_14','day_15','day_16','day_17','day_18','day_19','day_20','day_21','day_22','day_23','day_24','day_25',
        'day_26','day_27','day_28','day_29','day_30','day_31','status'];
}
