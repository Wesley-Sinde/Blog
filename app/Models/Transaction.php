<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'date', 'tr_head_id', 'dr_amount','cr_amount', 'description','status'];

    public function trHead()
    {
        return $this->belongsTo(TransactionHead::class, 'id');
    }
}
