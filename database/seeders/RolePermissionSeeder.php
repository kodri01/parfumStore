<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionsModel;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = PermissionsModel::whereIn('id', range(1, 13))->get(); // Ambil permissions dengan ID 1 sampai 17

        foreach ($permissions as $permission) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => $permission->id,
                'role_id' => 1 // Masukkan ke role_id 1 untuk semua permission (ID 1-17)
            ]);
        }
    }
}