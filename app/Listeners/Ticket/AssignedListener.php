<?php

namespace App\Listeners\Ticket;

use App\Events\Ticket\AssignedEvent;
use App\Mail\TicketMail;
use App\Models\EmailTemplate;
use App\Library\File\EmailTemplates;
use Illuminate\Support\Facades\Mail;

class AssignedListener
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
     * @param  \App\Events\TicketAssign  $event
     * @return void
     */
    public function handle(AssignedEvent $event)
    {
        $data = $event->data;
        $email_settings = EmailTemplate::where('key', EmailTemplates::TICKET_ASSIGN)->first();
        $subject = $email_settings->subject;
        $data['email_message'] = $email_settings->message;

        Mail::to($event->email)->send(new TicketMail($subject, $data));

        //Activity Log Insert When Merge PAL-14
    }
}
