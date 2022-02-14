<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'institute', 'salogan','copyright', 'address','phone','email','website', 'favicon', 'email', 'logo',
        'print_header', 'print_footer', 'facebook', 'twitter', 'linkedIn', 'youtube', 'googlePlus',
        'instagram', 'whatsApp', 'skype', 'pinterest','wordpress', 'time_zones_id',
        'quick_menu', 'public_registration', 'front_desk', 'student_staff', 'account', 'inventory', 'library', 'attendance', 'exam', 'certificate', 'hostel', 'transport', 'assignment', 'upload_download', 'meeting', 'alert', 'academic', 'help',
        'status'];
}
