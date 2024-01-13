<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');
        $permissions = DB::table('permissions')->pluck('id');

        foreach ($permissions as $permission) {
            DB::table('permission_role')->insert([
                'role_id' => $adminRoleId,
                'permission_id' => $permission,
            ]);
        }
    }
}
