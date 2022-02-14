<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Month extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'title', 'status'];

    public function attendenceMaster()
    {
        return $this->hasMany(AttendenceMaster::class, 'month');
    }
}
