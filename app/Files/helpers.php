<?php

use App\Models\Config;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use App\Library\Services\Admin\ConfigService;

/**
 * Fetch config data by key
 *
 * @param  $key
 *
 * @return mixed
 */
function settings($key)
{
    static $config;

    if (is_null($config)) {
        $config = Cache::remember('config', 24 * 60, function () {
            return Config::pluck('value', 'key')->toArray();
        });
    }
    
    if (isset($config[$key])) {
        return (is_array($key)) ? Arr::only($config, $key) : $config[$key];
    }
}

/**
 * Update env file
 *
 * @param  $key means the key of env file
 * @param  $value associated with the key
 *
 * @return mixed
 */
function updateEnv($key, $value)
{
    $path = app()->environmentFilePath();

    $escaped = preg_quote('=' . env($key), '/');

    file_put_contents($path, preg_replace(
        "/^{$key}{$escaped}/m",
        "{$key}={$value}",
        file_get_contents($path)
    ));
}

function getDropdown(string $key)
{
    return ConfigService::getDropdown($key);
}

/**
 * Delete file
 *
 * @param  $path
 *
 * @return void
 */
function deleteFile($path)
{
    $paths = is_array($path) ? $path : [$path];

    foreach ($paths as $item) {
        if (File::exists(public_path($item))) {
            File::delete(public_path($item));
        }
    }
}

function getFormattedAmount($amount)
{
    return '$'.$amount;
}