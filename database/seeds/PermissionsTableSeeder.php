<?php

use App\Permission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'name' => 'Can Access Panel',
                'label' => 'can_access_panel',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Can Administrate',
                'label' => 'can_administrate',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Can Create Article',
                'label' => 'can_create_article',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ),
        );

        Permission::insert($data);
    }
}
