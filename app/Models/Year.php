<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'title', 'active_status', 'status'];

    public function attendenceMaster()
    {
        return $this->hasMany(AttendenceMaster::class, 'year');
    }
}
