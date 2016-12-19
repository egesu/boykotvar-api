<?php

use Illuminate\Database\Seeder;

class BoycottUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\BoycottUser::class, 1000)->create();
    }
}
