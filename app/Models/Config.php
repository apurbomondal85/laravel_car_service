<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value'
    ];

    public static function getByKey(string $key)
    {
        return self::where('key', $key)->first();
    }

    public static function updateConfig(string $key, string $value)
    {
        $config = self::firstOrNew(['key' => $key]);
        $config->value = $value;
        $config->save();
    }

    public static function getDropdowns(string $key)
    {
        $config = self::getByKey($key);

        return $config && $config->value ? json_decode($config->value) : [];
    }
}
