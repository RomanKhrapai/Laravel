<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = Role::where('name', 'admin')->first();
        $permissions = DB::table('permissions')->pluck('id');

        foreach ($permissions as $permission) {
            DB::table('permission_role')->insert([
                'role_id' => $admin->id,
                'permission_id' => $permission,
            ]);
        }
    }
}
