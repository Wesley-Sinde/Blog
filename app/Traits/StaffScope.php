<?php
namespace App\Traits;

use App\Models\Staff;
use App\Models\StaffDesignation;

trait StaffScope
{

    public function getStaffById($id)
    {
        $staff = Staff::find($id);
        if ($staff) {
            return $staff->reg_no;
        } else {
            return "Unknown";
        }
    }

    public function getStaffByReg($reg)
    {
        $staff = Staff::where('reg_no', $reg)->first();
        if ($staff) {
            return $staff->id;
        } else {
            return "Unknown";
        }
    }

    public function getStaffNameByReg($reg)
    {
        $staff = Staff::where('reg_no', $reg)->first();
        if ($staff) {
            return $staff->first_name . ' ' . $staff->middle_name . ' ' . $staff->last_name;
        } else {
            return "Unknown";
        }
    }

    public function getStaffNameById($id)
    {
        $staff = Staff::find($id);
        if ($staff) {
            return $staff->first_name . ' ' . $staff->middle_name . ' ' . $staff->last_name;
        } else {
            return "Unknown";
        }
    }

    public function getStaffDesignation($id)
    {
        $staff = Staff::find($id);
        if ($staff) {
            return $staff->designation;
        } else {
            return "Unknown";
        }
    }

    public function getDesignationId($id)
    {
        $designation = StaffDesignation::find($id);
        if ($designation) {
            return $designation->title;
        } else {
            return "Unknown";
        }
    }

    public function staffDesignationList()
    {
        $designation = StaffDesignation::select('id', 'title')->orderBy('title')->pluck('title', 'id')->toArray();
        return array_prepend($designation, 'Select Designation', '0');

    }

    //command filter condition
    public function commonStaffFilterCondition($query, $request)
    {
        if ($request->has('reg_no') && $request->get('reg_no') !=null) {
            $query->where('staff.reg_no', 'like', '%' . $request->reg_no . '%');
            $this->filter_query['staff.reg_no'] = $request->reg_no;
        }

        if ($request->has('join_date_start') && $request->has('join_date_end')) {
            $query->whereBetween('staff.join_date', [$request->get('join_date_start'), $request->get('join_date_end')]);
            $this->filter_query['join_date_start'] = $request->get('join_date_start');
            $this->filter_query['join_date_end'] = $request->get('join_date_end');
        } elseif ($request->has('join_date_start')) {
            $query->where('staff.join_date', '=', $request->get('join_date_start'));
            $this->filter_query['join_date_start'] = $request->get('join_date_start');
        } elseif ($request->has('join_date_end')) {
            $query->where('staff.join_date', '=', $request->get('join_date_end'));
            $this->filter_query['join_date_end'] = $request->get('join_date_end');
        }

        if ($request->get('designation') > 0) {
            $query->where('staff.designation', '=', $request->designation);
            $this->filter_query['staff.designation'] = $request->designation;
        }

        if ($request->has('status')) {
            $query->where('staff.status', $request->status == 'active' ? 1 : 0);
            $this->filter_query['staff.status'] = $request->get('status');
        }
    }

}