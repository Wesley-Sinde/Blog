<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountCategory extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'ac_name', 'ac_type', 'dr', 'cr', 'status'];


    public function tHead()
    {
        return $this->hasMany(TransactionHead::class, 'acc_id');
    }
}
