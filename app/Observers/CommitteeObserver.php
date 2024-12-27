<?php

namespace App\Observers;

use App\Models\Committee;
use App\Library\Helper;

class CommitteeObserver
{
    /**
     * Handle the Committee "created" event.
     *
     * @param  \App\Models\Committee  $committee
     * @return void
     */
    public function created(Committee $committee)
    {
        $difference = Helper::getDifference($committee, false, true);

        Helper::createActivityLog('Created', 'Committee', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Committee "updated" event.
     *
     * @param  \App\Models\Committee  $committee
     * @return void
     */
    public function updated(Committee $committee)
    {
        $difference = Helper::getDifference($committee, true);

        Helper::createActivityLog('Updated', 'Committee', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Committee "deleted" event.
     *
     * @param  \App\Models\Committee  $committee
     * @return void
     */
    public function deleted(Committee $committee)
    {
        $difference = Helper::getDifference($committee);

        Helper::createActivityLog('Deleted', 'Committee', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Committee "restored" event.
     *
     * @param  \App\Models\Committee  $committee
     * @return void
     */
    public function restored(Committee $committee)
    {
        $difference = Helper::getDifference($committee);

        Helper::createActivityLog('Restored', 'Committee', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Committee "force deleted" event.
     *
     * @param  \App\Models\Committee  $committee
     * @return void
     */
    public function forceDeleted(Committee $committee)
    {
        $difference = Helper::getDifference($committee);

        Helper::createActivityLog('Force Deleted', 'Committee', $difference, request()->ip(), request()->userAgent());
    }
}
