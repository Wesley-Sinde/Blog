<?php

use Illuminate\Database\Seeder;

class SmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/sms-gateway.json');
        $data = json_decode($json, true);

        foreach($data as $obj){
            DB::table('sms_settings')->insert([
                'identity' => $obj['identity'],
                'logo' => $obj['logo'],
                'link' => $obj['link'],
                'config' => json_encode($obj['config']),
                'status' => $obj['status']
            ]);
        }

    }
}
