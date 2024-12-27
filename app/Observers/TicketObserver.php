<?php

namespace App\Observers;

use App\Models\Ticket;
use App\Library\Helper;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function created(Ticket $ticket)
    {
        $difference = Helper::getDifference($ticket, false, true);

        Helper::createActivityLog('Created', 'Ticket', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Ticket "updated" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function updated(Ticket $ticket)
    {
        $difference = Helper::getDifference($ticket, true);

        Helper::createActivityLog('Updated', 'Ticket', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Ticket "deleted" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function deleted(Ticket $ticket)
    {
        $difference = Helper::getDifference($ticket, true);

        Helper::createActivityLog('Deleted', 'Ticket', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Ticket "restored" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function restored(Ticket $ticket)
    {
        $difference = Helper::getDifference($ticket, true);

        Helper::createActivityLog('Restored', 'Ticket', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Ticket "force deleted" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function forceDeleted(Ticket $ticket)
    {
        $difference = Helper::getDifference($ticket, true);

        Helper::createActivityLog('Force Deleted', 'Ticket', $difference, request()->ip(), request()->userAgent());
    }
}
