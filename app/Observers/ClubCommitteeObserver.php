<?php

namespace App\Observers;

use App\Models\ClubCommittee;
use App\Library\Helper;

class ClubCommitteeObserver
{
    /**
     * Handle the ClubCommittee "created" event.
     *
     * @param  \App\Models\ClubCommittee  $clubCommittee
     * @return void
     */
    public function created(ClubCommittee $clubCommittee)
    {
        $difference = Helper::getDifference($clubCommittee, false, true);

        Helper::createActivityLog('Created', 'Club Committee', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the ClubCommittee "updated" event.
     *
     * @param  \App\Models\ClubCommittee  $clubCommittee
     * @return void
     */
    public function updated(ClubCommittee $clubCommittee)
    {
        $difference = Helper::getDifference($clubCommittee, true);

        Helper::createActivityLog('Updated', 'Club Committee', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the ClubCommittee "deleted" event.
     *
     * @param  \App\Models\ClubCommittee  $clubCommittee
     * @return void
     */
    public function deleted(ClubCommittee $clubCommittee)
    {
        $difference = Helper::getDifference($clubCommittee);

        Helper::createActivityLog('Deleted', 'Club Committee', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the ClubCommittee "restored" event.
     *
     * @param  \App\Models\ClubCommittee  $clubCommittee
     * @return void
     */
    public function restored(ClubCommittee $clubCommittee)
    {
        $difference = Helper::getDifference($clubCommittee);

        Helper::createActivityLog('Restored', 'Club Committee', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the ClubCommittee "force deleted" event.
     *
     * @param  \App\Models\ClubCommittee  $clubCommittee
     * @return void
     */
    public function forceDeleted(ClubCommittee $clubCommittee)
    {
        $difference = Helper::getDifference($clubCommittee);

        Helper::createActivityLog('Force Deleted', 'Club Committee', $difference, request()->ip(), request()->userAgent());
    }
}
