<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends BaseModel
{
    //
    protected $fillable = ['created_by', 'last_updated_by', 'member_type', 'member_id',  'title', 'file','description', 'status'];


}
