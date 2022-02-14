<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentAnswer extends BaseModel
{
    protected $fillable = ['created_by','last_updated_by','assignments_id','students_id','answer_text','file','approve_status','status'];


}
