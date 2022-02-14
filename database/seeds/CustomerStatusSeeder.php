<?php

use Illuminate\Database\Seeder;

class CustomerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_statuses')->insert([
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'last_updated_by' => 1,
                'title' => 'New Customer',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'last_updated_by' => 1,
                'title' => 'Annual Contract',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'last_updated_by' => 1,
                'title' => 'Office Contract',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'last_updated_by' => 1,
                'title' => 'Individual',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'last_updated_by' => 1,
                'title' => 'inquiry/Lead',
                'status' => 1
            ],
        ]);
    }
}
