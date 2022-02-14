<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends BaseModel
{
    protected $table = 'book_categories';
    protected $fillable = ['created_by', 'last_updated_by', 'title', 'slug', 'status'];
}
