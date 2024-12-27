<?php

namespace Database\Seeders;

use App\Library\Enum;
use App\Models\Config;
use Illuminate\Database\Seeder;

class DropdownSeeder extends Seeder
{
    public function run()
    {
        $records = self::getRecords();

        foreach ($records as $record) {
            $values = getDropdown($record['dropdown']);
            $values[] = $record['name'];
            self::updateConfig($record['dropdown'], json_encode($values, true));
        }
    }

    private static function getRecords()
    {
        return [
            /*CONFIG_DROPDOWN_TICKET_DEPARTMENT*/
            [
                'name'     => 'Customer Service',
                'dropdown' => Enum::CONFIG_DROPDOWN_TICKET_DEPARTMENT,
            ],
            [
                'name'     => 'On Field Service',
                'dropdown' => Enum::CONFIG_DROPDOWN_TICKET_DEPARTMENT,
            ],
            [
                'name'     => 'Accounts Service',
                'dropdown' => Enum::CONFIG_DROPDOWN_TICKET_DEPARTMENT,
            ],

            /*CONFIG_DROPDOWN_NOTIFICATION_TYPE*/
            [
                'name'     => 'Weekly Announcement',
                'dropdown' => Enum::CONFIG_DROPDOWN_NOTIFICATION_TYPE,
            ],
            [
                'name'     => 'Monthly Announcement',
                'dropdown' => Enum::CONFIG_DROPDOWN_NOTIFICATION_TYPE,
            ],
            [
                'name'     => 'Daily Announcement',
                'dropdown' => Enum::CONFIG_DROPDOWN_NOTIFICATION_TYPE,
            ],

            /*CONFIG_DROPDOWN_GENDER*/
            [
                'name'     => 'Male',
                'dropdown' => Enum::CONFIG_DROPDOWN_GENDER,
            ],
            [
                'name'     => 'FeMale',
                'dropdown' => Enum::CONFIG_DROPDOWN_GENDER,
            ],
            [
                'name'     => 'Others',
                'dropdown' => Enum::CONFIG_DROPDOWN_GENDER,
            ],


            /*CONFIG_DROPDOWN_PRONOUN*/
            [
                'name'     => 'He',
                'dropdown' => Enum::CONFIG_DROPDOWN_PRONOUN,
            ],
            [
                'name'     => 'She',
                'dropdown' => Enum::CONFIG_DROPDOWN_PRONOUN,
            ],
            [
                'name'     => 'Other',
                'dropdown' => Enum::CONFIG_DROPDOWN_PRONOUN,
            ],

            /*CONFIG_DROPDOWN_PRONOUN*/
            [
                'name'     => 'Mr.',
                'dropdown' => Enum::CONFIG_DROPDOWN_USER_TITLE,
            ],
            [
                'name'     => 'Mrs.',
                'dropdown' => Enum::CONFIG_DROPDOWN_USER_TITLE,
            ],
            [
                'name'     => 'Other',
                'dropdown' => Enum::CONFIG_DROPDOWN_USER_TITLE,
            ],

        ];
    }

    private static function updateConfig(string $key, string $value)
    {
        $config = Config::firstOrNew(['key' => $key]);
        $config->value = $value;
        $config->save();

    }
}
