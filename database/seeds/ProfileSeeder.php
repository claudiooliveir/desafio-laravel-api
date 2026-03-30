<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = [[
         'name' => 'admin',

        ]];

        foreach ($profile as $key => $value) {
            DB::table('profiles')->insert($value);
            
    }
}
}