<?php

namespace App\Listeners\Transaction;

use App\Events\Transaction\PaymentEvent;

use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class PaymentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PaymentEvent $event)
    {
        $event = $event->transaction;

        $payment = new Payment();
        $payment->trx_id = $event->id;
        $payment->user_id = $event->user_id;
        $payment->payment_method = $event->payment_method;
        $payment->amount = $event->amount;
        $payment->type = $event->type;

        $payment->created_by = Auth::user()->id;


        $payment->save();
    }
}
