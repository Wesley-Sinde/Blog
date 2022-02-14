<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'purchase_id', 'products_id', 'quantity', 'rate', 'total_amount', 'discount', 'status'];

}
