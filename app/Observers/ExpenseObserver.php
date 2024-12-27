<?php

namespace App\Observers;

use App\Models\Expense;
use App\Library\Helper;

class ExpenseObserver
{
    /**
     * Handle the Expense "created" event.
     *
     * @param  \App\Models\Expense  $expense
     * @return void
     */
    public function created(Expense $expense)
    {
        $difference = Helper::getDifference($expense, false, true);

        Helper::createActivityLog('Created', 'Expense', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Expense "updated" event.
     *
     * @param  \App\Models\Expense  $expense
     * @return void
     */
    public function updated(Expense $expense)
    {
        $difference = Helper::getDifference($expense, true);

        Helper::createActivityLog('Updated', 'Expense', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Expense "deleted" event.
     *
     * @param  \App\Models\Expense  $expense
     * @return void
     */
    public function deleted(Expense $expense)
    {
        $difference = Helper::getDifference($expense);

        Helper::createActivityLog('Deleted', 'Expense', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Expense "restored" event.
     *
     * @param  \App\Models\Expense  $expense
     * @return void
     */
    public function restored(Expense $expense)
    {
        $difference = Helper::getDifference($expense);

        Helper::createActivityLog('Restored', 'Expense', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Expense "force deleted" event.
     *
     * @param  \App\Models\Expense  $expense
     * @return void
     */
    public function forceDeleted(Expense $expense)
    {
        $difference = Helper::getDifference($expense);

        Helper::createActivityLog('Force Deleted', 'Expense', $difference, request()->ip(), request()->userAgent());
    }
}
