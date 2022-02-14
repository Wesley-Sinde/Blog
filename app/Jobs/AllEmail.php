<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailAlerts;

class AllEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailIds;
    protected $subject;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emailIds, $subject, $message)
    {
        $this->emailIds = $emailIds;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $emailIds = $this->emailIds;
        Mail::to($emailIds)->send(new EmailAlerts([
            'subject' => $this->subject,
            'message' => $this->message,
        ]));

        /*if(count($emailIds) > 1){
            $mainId = Arr::first($emailIds,null,null);
            $ccIds = implode(',',Arr::except($emailIds,0));
            Mail::to('test@gmail.com')->send(new EmailAlerts([
                'subject' => $this->subject,
                'message' => $this->message,
            ]));

        }else{
            $mainId = Arr::first($emailIds,null,null);
            Mail::to($mainId)->send(new EmailAlerts([
                'subject' => $this->subject,
                'message' => $this->message,
            ]));
        }*/
    }
}
