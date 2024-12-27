<?php

namespace App\Observers;

use App\Models\Business;
use App\Library\Helper;

class BusinessObserver
{
    /**
     * Handle the Business "created" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function created(Business $business)
    {
        $difference = Helper::getDifference($business, false, true);

        Helper::createActivityLog('Created', 'Business', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Business "updated" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function updated(Business $business)
    {
        $difference = Helper::getDifference($business, true);

        Helper::createActivityLog('Updated', 'Business', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Business "deleted" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function deleted(Business $business)
    {
        $difference = Helper::getDifference($business);

        Helper::createActivityLog('Deleted', 'Business', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Business "restored" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function restored(Business $business)
    {
        $difference = Helper::getDifference($business);

        Helper::createActivityLog('Restored', 'Business', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Business "force deleted" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function forceDeleted(Business $business)
    {
        $difference = Helper::getDifference($business);

        Helper::createActivityLog('Force Deleted', 'Business', $difference, request()->ip(), request()->userAgent());
    }
}
