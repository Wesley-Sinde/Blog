<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookMaster extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'isbn_number', 'code', 'title', 'sub_title', 'image',
        'language', 'editor', 'categories', 'edition', 'edition_year', 'publisher', 'publish_year', 'series', 'author',
        'rack_location', 'price', 'total_pages', 'source', 'notes', 'status'];

    public function bookCollection()
    {
        return $this->hasMany(Book::class, 'book_masters_id');
    }

}
