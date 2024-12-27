<?php

namespace App\Observers;

use App\Models\Club;
use App\Library\Helper;

class ClubObserver
{
    /**
     * Handle the Club "created" event.
     *
     * @param  \App\Models\Club  $club
     * @return void
     */
    public function created(Club $club)
    {
        $difference = Helper::getDifference($club, false, true);

        Helper::createActivityLog('Created', 'Club', $club->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Club "updated" event.
     *
     * @param  \App\Models\Club  $club
     * @return void
     */
    public function updated(Club $club)
    {
        $difference = Helper::getDifference($club, true);

        Helper::createActivityLog('Updated', 'Club', $club->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Club "deleted" event.
     *
     * @param  \App\Models\Club  $club
     * @return void
     */
    public function deleted(Club $club)
    {
        $difference = Helper::getDifference($club);

        Helper::createActivityLog('Deleted', 'Club', $club->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Club "restored" event.
     *
     * @param  \App\Models\Club  $club
     * @return void
     */
    public function restored(Club $club)
    {
        $difference = Helper::getDifference($club);

        Helper::createActivityLog('Restored', 'Club', $club->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Club "force deleted" event.
     *
     * @param  \App\Models\Club  $club
     * @return void
     */
    public function forceDeleted(Club $club)
    {
        $difference = Helper::getDifference($club);

        Helper::createActivityLog('Force Deleted', 'Club', $club->id, $difference, request()->ip(), request()->userAgent());
    }
}
