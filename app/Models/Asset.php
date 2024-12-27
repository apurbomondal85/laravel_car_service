<?php

namespace App\Models;

use Exception;
use App\Library\Enum;
use App\Library\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'asset_type',
        'quantity',
        'description',
        'status',
        'price',
        'total',
        'stock',
        'attachments',
        'vender_info',
        'purchased_date',
        'warranty_date',
        'entry_date',
        'operator_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'operator_id');
    }

    public function getAssetImage()
    {
        $path = public_path($this->attachments);

        if ($this->attachments && is_file($path) && file_exists($path)) {
            return asset($this->attachments);
        }

        return asset(Enum::NO_AVATAR_PATH);
    }


    // For Filtering
    public static function filterTable(array $params)
    {
        $query = Asset::select('*');

        if (isset($params['is_deleted']) && $params['is_deleted'] == 1) {
            $query->onlyTrashed();
        } elseif (isset($params['status'])) {
            $query->where('status', $params['status']);
        }

        return $query->get();
    }

    // For Filtering
    public static function filterTableForReport(array $params)
    {
        $startDate = isset($params['startDate']) ? date('Y-m-d', strtotime($params['startDate'])) : date('Y-m-d', strtotime('1900-01-1'));
        $endDate = isset($params['endDate']) ? date('Y-m-d', strtotime($params['endDate'])) : now();

        $query = Asset::select('*')->where('purchased_date', '>=', $startDate)->where('purchased_date', '<=', $endDate);

        if (isset($params['status']) && $params['status'] != 3) {
            $query->where("status", $params['status']);
        }

        return $query->get();
    }

    // Insert/Create Asset
    public static function insert(array $data)
    {
        DB::beginTransaction();

        try {

            $data['stock'] = $data['quantity'];
            $data['operator_id'] = Auth::user()->id;

            if (isset($data['attachments'])) {
                $data['attachments'] = Helper::uploadImage($data['attachments'], Enum::ASSET_DOCUMENTS, 200, 200);
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

    // Update Asset
    public static function edit(self $asset, array $data)
    {
        DB::beginTransaction();

        try {

            $data['stock'] = $data['quantity'];
            $data['operator_id'] = Auth::user()->id;

            if (isset($data['attachments'])) {
                $data['attachments'] = Helper::uploadImage($data['attachments'], Enum::ASSET_DOCUMENTS, 200, 200);
            }

            $asset->update($data);

            DB::commit();

            return true;
        } catch (Exception $e) {
            Helper::log($e);
            DB::rollback();

            return false;
        }
    }

    // Update Asset
    public static function updateAsset(self $asset, array $data)
    {
        DB::beginTransaction();

        try {

            $asset->update([
                'stock' => $asset->stock - $data['quantity'],
            ]);

            $findParent = self::whereParentId($asset->id)->whereStatus($data['status'])->first();

            if ($findParent) {

                Asset::where('id', $findParent->id)->update([
                    'quantity' => $findParent->quantity + $data['quantity'],
                    'total'    => $findParent->total + $data['quantity'] * $findParent->price,
                    'stock'    => $findParent->stock + $data['quantity'],
                ]);
            } else {

                $data['total'] = $data['quantity'] * $asset->price;
                $data['stock'] = $data['quantity'];
                $data['price'] = $asset->price;
                $data['parent_id'] = $asset->id;
                $data['name'] = $asset->name;
                $data['asset_type'] = $asset->asset_type;
                $data['description'] = $asset->description;
                $data['purchased_date'] = $asset->purchased_date;
                $data['warranty_date'] = $asset->warranty_date;
                $data['vender_info'] = $asset->vender_info;
                $data['attachments'] = $asset->attachments;
                $data['operator_id'] = auth()->id();

                Asset::create($data);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            Helper::log($e);
            DB::rollback();

            return false;
        }
    }
}
