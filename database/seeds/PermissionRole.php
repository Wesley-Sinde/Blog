<?php
use Illuminate\Database\Seeder;

class PermissionRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 1; $x <= 531; $x++) {
            DB::table('permission_role')->insert([
                ['permission_id'=> $x, 'role_id' => 1]
            ]);
        }
    }
}
