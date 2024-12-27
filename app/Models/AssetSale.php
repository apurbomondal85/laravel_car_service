<?php

namespace App\Models;

use Exception;
use App\Library\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'name',
        'quantity',
        'price',
        'total',
        'lose_or_profit',
        'sale_to',
        'sale_date',
        'note',
        'operator_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'operator_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    // Insert/Create
    public static function insert($asset, array $data)
    {
        DB::beginTransaction();

        try {
            $depreciation_cost = ($data['price'] * $data['quantity']) - ($asset->price * $data['quantity']);

            $data['lose_or_profit'] = $depreciation_cost;
            $data['operator_id'] = Auth::user()->id;

            self::create($data);

            $asset->update([
                'stock' => $asset->stock - $data['quantity'],
            ]);

            DB::commit();

            return true;

        } catch (Exception $e) {
            Helper::log($e);
            DB::rollback();

            return false;
        }
    }

    public static function edit($asset, self $assetSale, array $data)
    {
        DB::beginTransaction();

        try {
            $pre_sale_quan = $assetSale->quantity;

            $depreciation_cost = ($data['price'] * $data['quantity']) - ($asset->price * $data['quantity']);

            $data['lose_or_profit'] = $depreciation_cost;
            $data['operator_id'] = Auth::user()->id;

            $assetSale->update($data);

            $asset->update([
                'stock' => $asset->stock + $pre_sale_quan - $data['quantity'],
            ]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
