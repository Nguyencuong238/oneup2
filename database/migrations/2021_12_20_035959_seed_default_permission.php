<?php

use App\Models\Permission;
use Illuminate\Database\Migrations\Migration;

class SeedDefaultPermission extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'posts.view',
            ],
            [
                'name' => 'posts.create',
            ],
            [
                'name' => 'posts.edit',
            ],
            [
                'name' => 'posts.delete',
            ],

            [
                'name' => 'tags.view',
            ],
            [
                'name' => 'tags.create',
            ],
            [
                'name' => 'tags.edit',
            ],
            [
                'name' => 'tags.delete',
            ],

            [
                'name' => 'categories.view',
            ],
            [
                'name' => 'categories.create',
            ],
            [
                'name' => 'categories.edit',
            ],
            [
                'name' => 'categories.delete',
            ],

            [
                'name' => 'banners.view',
            ],
            [
                'name' => 'banners.create',
            ],
            [
                'name' => 'banners.edit',
            ],
            [
                'name' => 'banners.delete',
            ],

            [
                'name' => 'videos.view',
            ],
            [
                'name' => 'videos.create',
            ],
            [
                'name' => 'videos.edit',
            ],
            [
                'name' => 'videos.delete',
            ],

            [
                'name' => 'users.view',
            ],
            [
                'name' => 'users.create',
            ],
            [
                'name' => 'users.edit',
            ],
            [
                'name' => 'users.delete',
            ],

            [
                'name' => 'roles.view',
            ],
            [
                'name' => 'roles.create',
            ],
            [
                'name' => 'roles.edit',
            ],
            [
                'name' => 'roles.delete',
            ],

            [
                'name' => 'setting.home',
            ],
        ];

        foreach ($permissions as $p) {
            Permission::create($p);
        }
    }
}
