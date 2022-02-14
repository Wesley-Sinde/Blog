<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'book_masters_id', 'book_code', 'book_status'];

    public function bookMaster()
    {
        return $this->belongsTo(BookMaster::class, 'id');
    }

    public function bookStatus()
    {
        return $this->belongsTo(BookStatus::class, 'id');
    }

    public function libBookIssue()
    {
        return $this->hasMany(BookIssue::class, 'book_id');
    }
}
