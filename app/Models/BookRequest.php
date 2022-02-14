<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    protected $fillable = ['created_by', 'last_updated_by', 'book_masters_id', 'member_id', 'status'];

    public function bookMaster()
    {
        return $this->belongsTo(BookMaster::class, 'id','book_masters_id');
    }
}
