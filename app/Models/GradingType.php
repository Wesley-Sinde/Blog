<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradingType extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'title', 'slug', 'status'];

    public function gradingScale()
    {
        return $this->hasMany(GradingScale::class, 'gradingType_id');
    }

}
