<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WaitRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public function __construct($data)
    {
        $this->data=$data;
    }
    public function build()
    {
        return $this->view('emails.waitRegisterMail')
                    ->with(['name' => $this->data])
                    ->subject('AI 3D Scanning Solutions');
    }
}
