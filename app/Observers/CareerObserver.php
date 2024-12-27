<?php

namespace App\Observers;

use App\Models\Career;
use App\Library\Helper;

class CareerObserver
{
    /**
     * Handle the Career "created" event.
     *
     * @param  \App\Models\Career  $career
     * @return void
     */
    public function created(Career $career)
    {
        $difference = Helper::getDifference($career, false, true);

        Helper::createActivityLog('Created', 'Career', $career->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Career "updated" event.
     *
     * @param  \App\Models\Career  $career
     * @return void
     */
    public function updated(Career $career)
    {
        $difference = Helper::getDifference($career, true);

        Helper::createActivityLog('Updated', 'Career', $career->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Career "deleted" event.
     *
     * @param  \App\Models\Career  $career
     * @return void
     */
    public function deleted(Career $career)
    {
        $difference = Helper::getDifference($career);

        Helper::createActivityLog('Deleted', 'Career', $career->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Career "restored" event.
     *
     * @param  \App\Models\Career  $career
     * @return void
     */
    public function restored(Career $career)
    {
        $difference = Helper::getDifference($career);

        Helper::createActivityLog('Restored', 'Career', $career->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Career "force deleted" event.
     *
     * @param  \App\Models\Career  $career
     * @return void
     */
    public function forceDeleted(Career $career)
    {
        $difference = Helper::getDifference($career);

        Helper::createActivityLog('Force Deleted', 'Career', $career->id, $difference, request()->ip(), request()->userAgent());
    }
}
