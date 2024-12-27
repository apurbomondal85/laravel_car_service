<?php

namespace App\Observers;

use App\Models\AssetSale;
use App\Library\Helper;

class AssetSaleObserver
{
    /**
     * Handle the AssetSale "created" event.
     *
     * @param  \App\Models\AssetSale  $assetSale
     * @return void
     */
    public function created(AssetSale $assetSale)
    {
        $difference = Helper::getDifference($assetSale, false, true);

        Helper::createActivityLog('Created', 'AssetSale', $assetSale->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the AssetSale "updated" event.
     *
     * @param  \App\Models\AssetSale  $assetSale
     * @return void
     */
    public function updated(AssetSale $assetSale)
    {
        $difference = Helper::getDifference($assetSale, true);

        Helper::createActivityLog('Updated', 'AssetSale', $assetSale->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the AssetSale "deleted" event.
     *
     * @param  \App\Models\AssetSale  $assetSale
     * @return void
     */
    public function deleted(AssetSale $assetSale)
    {
        $difference = Helper::getDifference($assetSale);

        Helper::createActivityLog('Deleted', 'AssetSale', $assetSale->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the AssetSale "restored" event.
     *
     * @param  \App\Models\AssetSale  $assetSale
     * @return void
     */
    public function restored(AssetSale $assetSale)
    {
        $difference = Helper::getDifference($assetSale);

        Helper::createActivityLog('Restored', 'AssetSale', $assetSale->id, $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the AssetSale "force deleted" event.
     *
     * @param  \App\Models\AssetSale  $assetSale
     * @return void
     */
    public function forceDeleted(AssetSale $assetSale)
    {
        $difference = Helper::getDifference($assetSale);

        Helper::createActivityLog('Force Deleted', 'AssetSale', $assetSale->id, $difference, request()->ip(), request()->userAgent());
    }
}
