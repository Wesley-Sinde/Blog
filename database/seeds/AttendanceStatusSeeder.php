<?php

use Illuminate\Database\Seeder;

class AttendanceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendance_statuses')->insert([
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'title' => 'PRESENT',
                'display_class' => 'btn-primary',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'title' => 'ABSENT',
                'display_class' => 'btn-danger',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'title' => 'LATE',
                'display_class' => 'btn-warning',
                'status' => 1
            ],
            [
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'created_by' => 1,
            'title' => 'LEAVE',
            'display_class' => 'btn-success',
            'status' => 1
            ],
            [
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'created_by' => 1,
            'title' => 'HOLIDAY',
            'display_class' => 'btn-info',
            'status' => 1
            ]
        ]);
    }
}
