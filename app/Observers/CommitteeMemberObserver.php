<?php

namespace App\Observers;

use App\Models\CommitteeMember;
use App\Library\Helper;

class CommitteeMemberObserver
{
    /**
     * Handle the CommitteeMember "created" event.
     *
     * @param  \App\Models\CommitteeMember  $committeeMember
     * @return void
     */
    public function created(CommitteeMember $committeeMember)
    {
        $difference = Helper::getDifference($committeeMember, false, true);

        Helper::createActivityLog('Created', 'Committee Member', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the CommitteeMember "updated" event.
     *
     * @param  \App\Models\CommitteeMember  $committeeMember
     * @return void
     */
    public function updated(CommitteeMember $committeeMember)
    {
        $difference = Helper::getDifference($committeeMember, true);

        Helper::createActivityLog('Updated', 'Committee Member', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the CommitteeMember "deleted" event.
     *
     * @param  \App\Models\CommitteeMember  $committeeMember
     * @return void
     */
    public function deleted(CommitteeMember $committeeMember)
    {
        $difference = Helper::getDifference($committeeMember);

        Helper::createActivityLog('Deleted', 'Committee Member', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the CommitteeMember "restored" event.
     *
     * @param  \App\Models\CommitteeMember  $committeeMember
     * @return void
     */
    public function restored(CommitteeMember $committeeMember)
    {
        $difference = Helper::getDifference($committeeMember);

        Helper::createActivityLog('Restored', 'Committee Member', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the CommitteeMember "force deleted" event.
     *
     * @param  \App\Models\CommitteeMember  $committeeMember
     * @return void
     */
    public function forceDeleted(CommitteeMember $committeeMember)
    {
        $difference = Helper::getDifference($committeeMember);

        Helper::createActivityLog('Force Deleted', 'Committee Member', $difference, request()->ip(), request()->userAgent());
    }
}
