<?php

use App\User;
use Illuminate\Database\Seeder;
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
       //clear users tables
        User::truncate();

        $faker = \Faker\Factory::create();

        //Make everyone to have the same password and hash it before the loop / else our seeder will be too slow

        $password = Hash::make('secret');

        User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@test.com',
            'password'  => $password
        ]);

        //Generate doezen of users

        for ($i = 0, $i < 10 ; $i++; ){

            User::create([
                'name'      => $faker->name,
                'email'     => $faker->email,
                'password'  => $password,
            ]);
        }
    }
}
