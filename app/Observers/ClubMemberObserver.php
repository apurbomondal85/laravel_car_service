<?php

namespace App\Observers;

use App\Models\ClubMember;
use App\Library\Helper;

class ClubMemberObserver
{
    /**
     * Handle the ClubMember "created" event.
     *
     * @param  \App\Models\ClubMember  $clubMember
     * @return void
     */
    public function created(ClubMember $clubMember)
    {
        $difference = Helper::getDifference($clubMember, false, true);

        Helper::createActivityLog('Created', 'Club Member', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the ClubMember "updated" event.
     *
     * @param  \App\Models\ClubMember  $clubMember
     * @return void
     */
    public function updated(ClubMember $clubMember)
    {
        $difference = Helper::getDifference($clubMember, true);

        Helper::createActivityLog('Updated', 'Club Member', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the ClubMember "deleted" event.
     *
     * @param  \App\Models\ClubMember  $clubMember
     * @return void
     */
    public function deleted(ClubMember $clubMember)
    {
        $difference = Helper::getDifference($clubMember);

        Helper::createActivityLog('Deleted', 'Club Member', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the ClubMember "restored" event.
     *
     * @param  \App\Models\ClubMember  $clubMember
     * @return void
     */
    public function restored(ClubMember $clubMember)
    {
        $difference = Helper::getDifference($clubMember);

        Helper::createActivityLog('Restored', 'Club Member', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the ClubMember "force deleted" event.
     *
     * @param  \App\Models\ClubMember  $clubMember
     * @return void
     */
    public function forceDeleted(ClubMember $clubMember)
    {
        $difference = Helper::getDifference($clubMember);

        Helper::createActivityLog('Force Deleted', 'Club Member', $difference, request()->ip(), request()->userAgent());
    }
}
