<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateHistory extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'students_id','certificate','certificate_id','history_type','ref_text', 'status'];
}

