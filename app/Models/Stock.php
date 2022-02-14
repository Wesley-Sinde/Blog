<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'products_id', 'transaction_type','date','qty_in', 'qty_out', 'status'];
}
