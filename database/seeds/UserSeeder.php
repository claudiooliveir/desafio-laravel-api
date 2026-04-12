<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
            'name' => 'claudio',
            'email' => 'claudio@email.com',
            'password' => '123456',
            'cpf' => '123.456.789',
            'profile_id' => 1,
            'password' => Hash::make('123456'),
        ],
        ];

    foreach ($user as $key => $value) {
        DB::table('users')->insert($value);

}}};
