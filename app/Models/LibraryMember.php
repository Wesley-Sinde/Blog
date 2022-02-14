<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryMember extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'user_type', 'member_id', 'status'];

    public function libCirculation()
    {
        return $this->belongsTo(LibraryCirculation::class, 'user_type','id');
    }

    public function libBookIssue()
    {
        return $this->hasMany(BookIssue::class, 'member_id');
    }

    public function bookRequest()
    {
        return $this->belongsTo(BookRequest::class, 'member_id','id');
    }
}
