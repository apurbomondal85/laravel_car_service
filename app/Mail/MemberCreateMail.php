<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MemberCreateMail extends Mailable
{
    use Queueable;
    use SerializesModels;


    public $name;
    public $subject;
    public $message;

    public function __construct(string $name, string $subject, string $message)
    {
        $this->name = $name;
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
            view: 'admin.email.memberCreate',
        );
    }

    public function attachments()
    {
        return [];
    }
}
