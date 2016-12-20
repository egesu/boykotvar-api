<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash as Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 300)->create();

        App\User::create([
            'name' => 'admin',
            'email' => 'admin@boykotvar.org',
            'password' => '123456',
        ]);
    }
}
