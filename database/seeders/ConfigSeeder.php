<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // General Settings
            ['key' => 'app_title', 'value' => ''],
            ['key' => 'email', 'value' => ''],
            ['key' => 'country_code', 'value' => ''],
            ['key' => 'phone', 'value' => ''],
            ['key' => 'phone2', 'value' => ''],
            ['key' => 'logo', 'value' => ''],
            ['key' => 'favicon', 'value' => ''],
            ['key' => 'og_image', 'value' => ''],
            ['key' => 'address', 'value' => ''],
            ['key' => 'city', 'value' => ''],
            ['key' => 'state', 'value' => ''],
            ['key' => 'zip_code', 'value' => ''],
            ['key' => 'country', 'value' => ''],
            ['key' => 'copyright', 'value' => ''],
            ['key' => 'currency_name', 'value' => ''],
            ['key' => 'currency_symbol', 'value' => ''],
            ['key' => 'version', 'value' => ''],
            ['key' => 'admin_prefix', 'value' => ''],
            ['key' => 'user_quota', 'value' => ''],
            ['key' => 'membership_type', 'value' => '{"general":"100","premium":"200","lifetime":"500"}'],
        ];

        Config::insert($data);
    }
}
