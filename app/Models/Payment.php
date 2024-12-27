<?php

namespace App\Models;

use Throwable;
use App\Library\Enum;
use App\Library\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Events\Transaction\PaymentEvent;
use App\Events\Transaction\MembershipExpireEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_id',
        'user_id',
        'payment_method',
        'amount',
        'type',
        'created_by',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'id', 'trx_id');
    }


    // For Transaction Report Filtering
    public static function filterTableForReport(array $params)
    {
        $startDate = isset($params['startDate']) ? date('Y-m-d', strtotime($params['startDate'])) : date('Y-m-d', strtotime('1900-01-1'));
        $endDate = isset($params['endDate']) ? date('Y-m-d', strtotime($params['endDate'])) : now();

        $query = Payment::select('*')->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate);

        if(isset($params['type']) && $params['type'] != 4) {
            $query->where("type", $params['type']);
        }

        return $query->get();
    }


    public static function latestPayment($user_id)
    {
        $payData = Payment::where('user_id', $user_id)->latest()->first();

        return $payData;
    }


    // Stripe Payment from frontend
    public static function stripePayment(array $data)
    {
        DB::beginTransaction();

        $data['user_id'] = auth()->id();
        unset($data['stripeToken']);

        try {
            $data['payment_method'] = 'stripe';
            $data['status'] = Enum::PAYMENT_METHOD_COMPLETED;
            $data['created_by'] = Auth::user()->id;

            $transaction = Transaction::create($data);

            event(new MembershipExpireEvent($transaction));

            $transaction['type'] = Enum::PAYMENT_TYPE_SUBSCRIPTION;
            event(new PaymentEvent($transaction));

            DB::commit();

            return true;

        } catch (Throwable $e) {
            Helper::log($e);
            DB::rollback();

            return false;
        }
    }
}
