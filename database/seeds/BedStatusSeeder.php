<?php

use Illuminate\Database\Seeder;

class BedStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bed_statuses')->insert([
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'title' => 'Available',
                'display_class' => 'btn-success',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'title' => 'Occupied',
                'display_class' => 'btn-primary',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'title' => 'Damage',
                'display_class' => 'btn-danger',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'title' => 'UnderConstruction',
                'display_class' => 'btn-default',
                'status' => 1
            ],
            [
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'created_by' => 1,
            'title' => 'UnderMaintinance',
            'display_class' => 'btn-default',
            'status' => 1
             ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'title' => 'NeedMaintinance',
                'display_class' => 'btn-default',
                'status' => 1
            ]
        ]);
    }
}
