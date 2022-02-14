<?php

namespace App\Mail;

use App\Models\GeneralSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAlerts extends Mailable
{
    use Queueable, SerializesModels;

    public $data;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($array)
    {
        $this->data = $array;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        $setting = GeneralSetting::select('institute', 'address','phone','email', 'website', 'logo',
            'print_header', 'print_footer', 'facebook', 'twitter', 'linkedIn', 'youtube')->first();

        return $this->from($setting->email, $setting->institute)
            ->subject($this->data['subject'])
            ->view('mail.alert',[
                'data' => $this->data,
                'generalSetting' => $setting
            ]);
    }
}
