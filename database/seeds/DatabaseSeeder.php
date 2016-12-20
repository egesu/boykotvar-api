<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UsersTableSeeder');
        $this->call('ConcernsTableSeeder');
        $this->call('BoycottsTableSeeder');
        $this->call('BoycottPostsTableSeeder');
        $this->call('BoycottUsersTableSeeder');
    }
}
