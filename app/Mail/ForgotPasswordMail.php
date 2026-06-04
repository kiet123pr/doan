<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data = [];
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from('kiet123pr@gmail.com', 'test')
            ->subject($this->data['subject'])
            ->view('mail.forgetPass')
            ->with('data', $this->data);
    }
}
