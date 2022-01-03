<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

         User::factory(10)->create();

           //permissions

        $this->permissionsSeeder();

        $this->assignPermissions();
    }
    protected function permissionsSeeder()
    {
        //clear
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('model_has_roles')->delete();
        DB::table('model_has_permissions')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // create roles:
        $roles = ['librarian','student'];
        foreach ($roles as $role) {
            Role::create(['name'=>$role]);
        }

    }
    public function assignPermissions()
    {
        foreach (User::all()->except(1,2) as $user){
            $user->assignRole('student');
        }
        $admin = User::find(1);
        $admin->name = 'Mash';
        $admin->email = 'moseskamau338@gmail.com';
        $admin->save();
        $admin->assignRole('librarian');

        User::find(2)->assignRole('librarian');
    }
}
