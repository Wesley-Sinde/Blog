<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'invoice_no', 'supplier_id', 'purchase_date', 'grand_total_amount', 'total_discount', 'purchase_details', 'status'];

}
