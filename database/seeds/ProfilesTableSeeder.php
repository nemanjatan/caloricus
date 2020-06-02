<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Profile for Nemanja Tanaskovic user
        DB::table('profiles')->insert([
            'user_id' => '1',
            'website' => 'nemanjatanaskovic.com',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Profile for Marko Tanaskovic user.
        DB::table('profiles')->insert([
            'user_id' => '2',
            'website' => 'markotanaskovic.com',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Profile for Danica Tanaskovic user.
        DB::table('profiles')->insert([
            'user_id' => '3',
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
