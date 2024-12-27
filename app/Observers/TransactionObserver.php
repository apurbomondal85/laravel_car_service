<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Library\Helper;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        $difference = Helper::getDifference($transaction, false, true);

        Helper::createActivityLog('Created', 'Transaction', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        $difference = Helper::getDifference($transaction, true);

        Helper::createActivityLog('Updated', 'Transaction', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        $difference = Helper::getDifference($transaction);

        Helper::createActivityLog('Deleted', 'Transaction', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        $difference = Helper::getDifference($transaction);

        Helper::createActivityLog('Restored', 'Transaction', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        $difference = Helper::getDifference($transaction);

        Helper::createActivityLog('Force Deleted', 'Transaction', $difference, request()->ip(), request()->userAgent());
    }
}
