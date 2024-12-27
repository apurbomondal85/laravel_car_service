<?php

namespace App\Models;

use App\Events\Transaction\MembershipExpireEvent;
use App\Events\Transaction\PaymentEvent;
use Throwable;
use App\Library\Enum;
use App\Library\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'membership_id',
        'transaction_id',
        'amount',
        'payment_method',
        'membership_expired_at',
        'status',
        'note',
        'created_by',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function member()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function membership()
    {
        return $this->hasOne(MembershipPlan::class, 'id', 'membership_id');
    }

    // Filter Datatable
    public static function filterTable(array $params)
    {
        $query = Transaction::select('*');

        if(isset($params['status'])) {
            $query->where('status', $params['status']);
        }

        return $query->get();
    }

    // Insert/Create subscription
    public static function insert(array $data)
    {
        try {
            $data['payment_method'] = 'manual';
            $data['status'] = Enum::PAYMENT_METHOD_PENDING;
            $data['created_by'] = Auth::user()->id;

            Transaction::create($data);

            return true;

        } catch (Throwable $e) {
            Helper::log($e);

            return false;
        }
    }

    // Update Status
    public static function updateStatus($transaction, $data)
    {
        DB::beginTransaction();
        // try {
        if($data['note'] == null) {
            unset($data['note']);
        }

        $transaction->update($data);

        if($transaction->status == Enum::PAYMENT_METHOD_COMPLETED) {

            event(new MembershipExpireEvent($transaction));

            $transaction['type'] = Enum::PAYMENT_TYPE_SUBSCRIPTION;
            event(new PaymentEvent($transaction));
        }

        DB::commit();

        return true;

        // } catch (Throwable $e) {
        //     Helper::log($e);
        //     DB::rollback();
        //     return false;
        // }
    }

}
