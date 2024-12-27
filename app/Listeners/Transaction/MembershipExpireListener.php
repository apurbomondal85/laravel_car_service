<?php

namespace App\Listeners\Transaction;

use App\Events\Transaction\MembershipExpireEvent;
use App\Library\Enum;
use App\Models\User;
use Carbon\Carbon;

class MembershipExpireListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(MembershipExpireEvent $event)
    {
        $event = $event->transaction;
        $expire_date = Carbon::now()->addYears(2);

        $event->update([
            'membership_expired_at' => $expire_date,
        ]);

        User::where('id', $event->user_id)->update([
            'status'                => (string) Enum::USER_STATUS_ACTIVE,
            'membership_id'         => $event->membership_id,
            'membership_expired_at' => $expire_date,
        ]);
    }
}
