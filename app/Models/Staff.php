<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'reg_no', 'join_date', 'designation', 'first_name',  'middle_name', 'last_name',
        'father_name', 'mother_name', 'date_of_birth', 'gender', 'blood_group', 'nationality','mother_tongue', 'address', 'state', 'country',
        'temp_address', 'temp_state', 'temp_country', 'home_phone', 'mobile_1', 'mobile_2', 'email', 'qualification',
        'experience', 'experience_info', 'other_info','staff_image', 'status'];

    public function staffNotes()
    {
        return $this->hasMany(Note::class,'member_id','id')->where('member_type','=','staff');
    }

    public function staffDocuments()
    {
        return $this->hasMany(Document::class,'member_id','id')->where('member_type','=','staff');
    }

    public function payrollMaster()
    {
        return $this->hasMany(PayrollMaster::class, 'staff_id');
    }

    public function paySalary()
    {
        return $this->hasMany(SalaryPay::class, 'staff_id');
    }

    //Library Member
    public function libraryMember()
    {
        return $this->hasMany(LibraryMember::class,'member_id','id')->where('user_type','=',2);
    }

    //transport User
    public function transportUser()
    {
        return $this->hasMany(TransportUser::class,'member_id','id')->where('user_type','=',2);
    }

    //Hostel Resident
    public function hostelResident()
    {
        return $this->hasMany(Resident::class,'member_id','id')->where('user_type','=',2);
    }

    //Regular Attendance
    public function regularAttendance()
    {
        return $this->hasMany(Attendance::class,'link_id','id')->where('attendees_type','=',2);
    }

}
