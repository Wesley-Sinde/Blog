<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by',  'title', 'status'];

    public function subCategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id','id');
    }

}
