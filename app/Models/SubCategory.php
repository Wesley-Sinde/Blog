<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'category_id', 'title', 'status'];

    public function category()
    {
        return $this->belongsTo(SubCategory::class, 'id');
    }

}
