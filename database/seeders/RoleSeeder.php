<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Administrator';
        $role->slug = 'super-admin';
        $role->save();

        $admin_user = User::where('email', env('ADMIN_EMAIL'))->first();

        if($admin_user) {
            $admin_user->roles()->attach($role);
        }
    }
}
