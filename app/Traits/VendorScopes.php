<?php
namespace App\Traits;

use App\Models\Vendor;
use App\Models\VendorStatus;

trait VendorScopes{

    public function getVendorById($id)
    {
        $customer = Vendor::find($id);
        if ($customer) {
            return $customer->reg_no;
        }else{
            return "Unknown";
        }
    }

    public function getVendorRegById($id)
    {
        $customer = Vendor::find($id);
        if ($customer) {
            return $customer->reg_no;
        }else{
            return "Unknown";
        }
    }

    public function getVendorIdByReg($reg_no)
    {
        $customer = Vendor::where('reg_no',$reg_no)->first();
        if ($customer) {
            return $customer->id;
        }else{
            return "Unknown";
        }
    }

    public function getVendorNameById($id)
    {
        $customer = Vendor::find($id);
        if ($customer) {
            return $customer->first_name .' '.$customer->middle_name.' '.$customer->last_name;
        }else{
            return "Unknown";
        }
    }

   
    public function getVendorNameByReg($reg)
    {
        $customer = Vendor::where('reg_no',$reg)->first();
        if ($customer) {
            return $customer->first_name .' '.$customer->middle_name.' '.$customer->last_name;
        }else{
            return "Unknown";
        }
    }

    public function getVendorStatus($id)
    {
        $customer = VendorStatus::where('id',$id)->first();
        if ($customer) {
            return $customer->title;
        }else{
            return "Unknown";
        }
    }


}