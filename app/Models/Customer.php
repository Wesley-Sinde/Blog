<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'reg_no','name', 'address', 'tel', 'mobile_1', 'mobile_2', 'email', 'extra_info', 'customer_image','customer_status','status'];

    public function serviceTaken()
    {
        return $this->hasMany(Service::class, 'customers_id', 'id');
    }

}
