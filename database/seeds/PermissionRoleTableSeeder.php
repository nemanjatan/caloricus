<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Personal Trainer <=> can_access_panel
        DB::table('permission_role')->insert([
            'role_id' => '2',
            'permission_id' => '1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Dietitian <=> can_access_panel
        DB::table('permission_role')->insert([
            'role_id' => '3',
            'permission_id' => '1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Admin <=> can_access_panel
        DB::table('permission_role')->insert([
            'role_id' => '4',
            'permission_id' => '1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Admin <=> can_view_any_nova_user
        DB::table('permission_role')->insert([
            'role_id' => '4',
            'permission_id' => '2',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Personal Trainer <=> can_create_article
        DB::table('permission_role')->insert([
            'role_id' => '2',
            'permission_id' => '3',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Dietitian <=> can_create_article
        DB::table('permission_role')->insert([
            'role_id' => '3',
            'permission_id' => '3',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Admin <=> can_create_article
        DB::table('permission_role')->insert([
            'role_id' => '4',
            'permission_id' => '3',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
