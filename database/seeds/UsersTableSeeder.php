<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'   => '1',
            'nama'      => 'Administrator',
            'nrp'       => '123456789',
            'foto'      => 'default.jpg',
            'password'  => Hash::make('123456789')
        ]);
        
        DB::table('users')->insert([
            'role_id'   => '2',
            'nama'      => 'Izzan',
            'nrp'       => '987654321',
            'foto'      => 'default.jpg',
            'password'  => Hash::make('987654321')
        ]);
    }
}
