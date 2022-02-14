<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;

class BaseModel extends Model implements AuditableContract
{

    use Auditable;

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = preg_replace('/\s+/u', '-', trim($value));
        //$this->attributes['slug'] = $this->make_slug($value);
        //$this->attributes['slug'] = str_slug($value);
    }

    /*public function getIDAttribute($value)
    {
        return $id = Crypt::encryptString($value);
    }

    public function setIDAttribute($value)
    {
        $this->attributes['id'] = Crypt::decryptString($value);
    }*/


    public function getStatusAttribute($value)
    {
        if($value == 1){
            $status = 'active';
        }elseif($value == 0){
            $status = 'in-active';
        }else{
            $status = $value;
        }
        return $status;
    }

    public function setStatusAttribute($value)
    {
        //$this->attributes['status'] = $value == 'active'?1:0;

        if($value == 'active'){
            $status = 1;
        }elseif($value == 'in-active'){
            $status = 0;
        }else{
            $status = $value;
        }

        $this->attributes['status'] = $status;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInActive($query)
    {
        return $query->where('status', 0);
    }


    //activity tracking
    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }

    public function getCreatedByNameAttribute()
    {
        return User::where('id', $this->created_by)->pluck('name')->first();
    }

    public function getUpdatedByNameAttribute()
    {
        return User::where('id', $this->last_updated_by)->pluck('name')->first();
    }


    public function getProductStock()
    {
        $stockIn = Stock::where('products_id', $this->id)->sum('qty_in');
        $stockOut = Stock::where('products_id', $this->id)->sum('qty_out');
        return $stock = $stockIn - $stockOut;
    }

    public function getProductSellPrice()
    {
        return ProductPrice::where('products_id', $this->id)->pluck('sale_price')->first();
    }
}