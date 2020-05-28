<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Nemanja Tanaskovic <=> Regular user
        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Nemanja Tanaskovic <=> Personal Trainer
        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '2',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Nemanja Tanaskovic <=> Dietitian
        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '3',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Nemanja Tanaskovic <=> Admin
        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '4',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Marko Tanaskovic <=> Regular user
        DB::table('role_user')->insert([
            'user_id' => '2',
            'role_id' => '1',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Marko Tanaskovic <=> Personal Trainer
        DB::table('role_user')->insert([
            'user_id' => '2',
            'role_id' => '2',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Marko Tanaskovic <=> Dietitian
        DB::table('role_user')->insert([
            'user_id' => '2',
            'role_id' => '3',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
