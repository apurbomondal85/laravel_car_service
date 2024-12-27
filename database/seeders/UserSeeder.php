<?php

namespace Database\Seeders;

use App\Models\User;
use App\Library\Enum;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->f_name = "DW";
        $user->l_name = "Admin";
        $user->email = env('ADMIN_EMAIL');
        $user->password = bcrypt(env('ADMIN_PASSWORD'));
        $user->mobile = '+880 1700000000';
        $user->dob = date('2000-02-02');
        $user->user_type = Enum::USER_TYPE_ADMIN;
        $user->status = Enum::USER_STATUS_ACTIVE;
        $user->login_access = true;
        $user->save();

        $user_profile = new UserProfile();
        $user_profile->user_id = $user->id;
        $user_profile->title = getDropdown(Enum::CONFIG_DROPDOWN_USER_TITLE)[0];
        $user_profile->gender = getDropdown(Enum::CONFIG_DROPDOWN_GENDER)[0];
        $user_profile->save();
    }
}
