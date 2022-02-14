<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends BaseModel
{

    protected $fillable = ['created_by', 'last_updated_by', 'students_id', 'date', 'amount', 'payment_gateway', 'ref_no', 'ref_text', 'status'];

}
