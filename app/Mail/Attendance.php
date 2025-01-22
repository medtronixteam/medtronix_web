<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Attendance extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $present, $leave,$absent,$date,$workHome;

    public function __construct($present,$absent,$leave,$workHome,$date)
    {
        $this->present=$present;
        $this->leave=$leave;
        $this->absent=$absent;
        $this->workHome=$workHome;
        $this->date=$date;
    }

    public function build()
    {
        return $this->view('emails.attendance')
                    ->with(['date' => $this->date,'present'=>$this->present,'absent'=>$this->absent,'leave'=>$this->leave,'workHome'=>$this->workHome])
                    ->subject('Attendance Report Medtronix Systems');
    }
    /**
     * Get the message envelope.
     */

}
