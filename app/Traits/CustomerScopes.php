<?php
namespace App\Traits;

use App\Models\Customer;
use App\Models\CustomerStatus;

trait CustomerScopes{

    public function getCustomerById($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            return $customer->reg_no;
        }else{
            return "Unknown";
        }
    }

    public function getCustomerRegById($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            return $customer->reg_no;
        }else{
            return "Unknown";
        }
    }

    public function getCustomerIdByReg($reg_no)
    {
        $customer = Customer::where('reg_no',$reg_no)->first();
        if ($customer) {
            return $customer->id;
        }else{
            return "Unknown";
        }
    }

    public function getCustomerNameById($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            return $customer->first_name .' '.$customer->middle_name.' '.$customer->last_name;
        }else{
            return "Unknown";
        }
    }

   
    public function getCustomerNameByReg($reg)
    {
        $customer = Customer::where('reg_no',$reg)->first();
        if ($customer) {
            return $customer->first_name .' '.$customer->middle_name.' '.$customer->last_name;
        }else{
            return "Unknown";
        }
    }

    public function getCustomerStatus($id)
    {
        $customer = CustomerStatus::where('id',$id)->first();
        if ($customer) {
            return $customer->title;
        }else{
            return "Unknown";
        }
    }


}