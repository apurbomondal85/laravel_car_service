<?php

namespace App\Observers;

use App\Models\Payment;
use App\Library\Helper;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {
        $difference = Helper::getDifference($payment, false, true);

        Helper::createActivityLog('Created', 'Payment', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Payment "updated" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        $difference = Helper::getDifference($payment, true);

        Helper::createActivityLog('Updated', 'Payment', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Payment "deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        $difference = Helper::getDifference($payment);

        Helper::createActivityLog('Deleted', 'Payment', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Payment "restored" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        $difference = Helper::getDifference($payment);

        Helper::createActivityLog('Restored', 'Payment', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Payment "force deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        $difference = Helper::getDifference($payment);

        Helper::createActivityLog('Force Deleted', 'Payment', $difference, request()->ip(), request()->userAgent());
    }
}
