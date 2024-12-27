<?php

namespace App\Listeners\Ticket;

use App\Events\Ticket\RepliedEvent;
use App\Mail\TicketMail;
use App\Models\EmailTemplate;
use App\Library\File\EmailTemplates;
use Illuminate\Support\Facades\Mail;

class RepliedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TicketReply  $event
     * @return void
     */
    public function handle(RepliedEvent $event)
    {
        $data = $event->data;
        $email_settings = EmailTemplate::where('key', EmailTemplates::TICKET_REPLY)->first();
        $subject = $email_settings->subject;
        $data['email_message'] = $email_settings->message;

        Mail::to($event->email)->send(new TicketMail($subject, $data));

        //Activity Log Insert When Merge PAL-14
    }
}
