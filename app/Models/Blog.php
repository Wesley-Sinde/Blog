<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $fillable = [
        'id', 'title', 'slug', 'description', 'image_path', 'user_id'
    ];
}
