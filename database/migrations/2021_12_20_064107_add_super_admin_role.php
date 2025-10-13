<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

class AddSuperAdminRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $role = Role::create([
            'name' => 'Super Admin',
        ]);

        $permssions = Permission::get();

        $role->givePermissionTo($permssions);

        // User::first()->assignRole($role);
    }
}
