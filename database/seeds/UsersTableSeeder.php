<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@gmail.com',
            'admin' => 1,
            'avatar' => asset('avatar/avatar.png')
        ]);
    }
}
