<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterCertificate extends Model
{
    protected $fillable = ['created_by', 'last_updated_by', 'students_id', 'date_of_issue','cc_num', 'year','character','ref_text','status'];
}
