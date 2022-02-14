<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'products_id', 'cost_price','sale_price', 'status'];
}
