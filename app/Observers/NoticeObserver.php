<?php

namespace App\Observers;

use App\Models\Notice;
use App\Library\Helper;

class NoticeObserver
{
    /**
     * Handle the Notice "created" event.
     *
     * @param  \App\Models\Notice  $notice
     * @return void
     */
    public function created(Notice $notice)
    {
        $difference = Helper::getDifference($notice, false, true);

        Helper::createActivityLog('Created', 'Notice', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Notice "updated" event.
     *
     * @param  \App\Models\Notice  $notice
     * @return void
     */
    public function updated(Notice $notice)
    {
        $difference = Helper::getDifference($notice, true);

        Helper::createActivityLog('Updated', 'Notice', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Notice "deleted" event.
     *
     * @param  \App\Models\Notice  $notice
     * @return void
     */
    public function deleted(Notice $notice)
    {
        $difference = Helper::getDifference($notice);

        Helper::createActivityLog('Deleted', 'Notice', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Notice "restored" event.
     *
     * @param  \App\Models\Notice  $notice
     * @return void
     */
    public function restored(Notice $notice)
    {
        $difference = Helper::getDifference($notice);

        Helper::createActivityLog('Restored', 'Notice', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Notice "force deleted" event.
     *
     * @param  \App\Models\Notice  $notice
     * @return void
     */
    public function forceDeleted(Notice $notice)
    {
        $difference = Helper::getDifference($notice);

        Helper::createActivityLog('Force Deleted', 'Notice', $difference, request()->ip(), request()->userAgent());
    }
}
