<?php

namespace App\Models;

use App\Events\Transaction\PaymentEvent;
use App\Library\Enum;
use App\Library\Helper;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_type',
        'type',
        'title',
        'user_id',
        'contact_person',
        'url',
        'description',
        'start_date',
        'end_date',
        'amount',
        'note',
        'business_logo',
        'ranking',
        'is_active',
        'is_payment',
        'created_by',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function getBusinessLogo()
    {
        $path = public_path($this->business_logo);

        if($this->business_logo && is_file($path) && file_exists($path)) {
            return asset($this->business_logo);
        }

        return asset(Enum::NO_AVATAR_PATH);
    }

    // For Filtering
    public static function filterTable(array $params, $type)
    {
        $query = Business::query();

        if(isset($params['status'])) {
            $query->where('is_active', $params['status'])->where('type', $type);
        }

        return $query;
    }

    // Insert/Create Business
    public static function insert(array $data, $type)
    {
        DB::beginTransaction();

        try {
            $data['type'] = $type;
            $data['ranking'] = Enum::BUSINESS_RANKING_BRONGE;
            $data['created_by'] = Auth::user()->id;

            if(isset($data['business_logo'])) {
                $data['business_logo'] = Helper::uploadImage($data['business_logo'], Enum::BUSINESS_FEATURE_IMAGE, 200, 200);
            }

            self::create($data);

            DB::commit();

            return true;

        } catch (Exception $e) {
            Helper::log($e);
            DB::rollback();

            return false;
        }
    }

    // Update Business
    public static function edit(self $business, array $data)
    {
        DB::beginTransaction();

        try {

            if(isset($data['business_logo'])) {
                $data['business_logo'] = Helper::uploadImage($data['business_logo'], Enum::BUSINESS_FEATURE_IMAGE, 200, 200);
            }

            $business->update($data);

            DB::commit();

            return true;
        } catch(Exception $e) {
            Helper::log($e);
            DB::rollback();

            return false;
        }
    }


    // Confirm Payment
    public static function confirmPayment($business)
    {
        DB::beginTransaction();

        try {

            $business->update([
                'is_payment' => 1,
            ]);

            $business['payment_method'] = 'manual';

            event(new PaymentEvent($business));

            DB::commit();

            return true;

        } catch (Exception $e) {
            Helper::log($e);
            DB::rollback();

            return false;
        }
    }
}
