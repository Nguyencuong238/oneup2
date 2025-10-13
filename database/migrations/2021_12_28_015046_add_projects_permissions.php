<?php

use App\Models\Permission;
use Illuminate\Database\Migrations\Migration;

class AddProjectsPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            [
                'name' => 'projects.view',
            ],
            [
                'name' => 'projects.create',
            ],
            [
                'name' => 'projects.edit',
            ],
            [
                'name' => 'projects.delete',
            ],
        ];

        foreach ($permissions as $p) {
            Permission::create($p);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
