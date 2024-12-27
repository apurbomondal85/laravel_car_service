<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DefaultMail extends Mailable
{
    use Queueable;
    use SerializesModels;


    public $subject;
    public $message;

    public function __construct(string $subject, string $message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }


    public function envelope()
    {
        return new Envelope(
            subject: $this->subject,
        );
    }


    public function content()
    {
        return new Content(
            view: 'email.default',
        );
    }

    public function attachments()
    {
        return [];
    }
}
