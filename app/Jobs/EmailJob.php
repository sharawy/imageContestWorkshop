<?php

namespace App\Jobs;
use Log;
use Illuminate\Support\Facades\Mail;
class EmailJob extends Job
{
    protected $msg_body;
    protected $email;
    protected $subject;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($msg_body,$email,$subject)
    {
        $this->msg_body=$msg_body;
        $this->email=$email;
        $this->subject=$subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      echo "sending email to ".$this->email." result : ".Mail::raw($this->msg_body, function($msg)
      {
        $msg->to([$this->email]);
        $msg->from(['info@atlas-admin.com']);
        $msg->subject($this->subject);
      });
    }
}
