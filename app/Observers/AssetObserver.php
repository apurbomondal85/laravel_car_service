<?php

namespace App\Observers;

use App\Models\Asset;
use App\Library\Helper;

class AssetObserver
{
    /**
     * Handle the Asset "created" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function created(Asset $asset)
    {
        $difference = Helper::getDifference($asset, false, true);

        Helper::createActivityLog('Created', 'Asset', $asset->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Asset "updated" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function updated(Asset $asset)
    {
        $difference = Helper::getDifference($asset, true);

        Helper::createActivityLog('Updated', 'Asset', $asset->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Asset "deleted" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function deleted(Asset $asset)
    {
        $difference = Helper::getDifference($asset);

        Helper::createActivityLog('Deleted', 'Asset', $asset->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Asset "restored" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function restored(Asset $asset)
    {
        $difference = Helper::getDifference($asset);

        Helper::createActivityLog('Restored', 'Asset', $asset->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Asset "force deleted" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function forceDeleted(Asset $asset)
    {
        $difference = Helper::getDifference($asset);

        Helper::createActivityLog('Force Deleted', 'Asset', $asset->id, $difference, request()->ip(), request()->userAgent());
    }
}
