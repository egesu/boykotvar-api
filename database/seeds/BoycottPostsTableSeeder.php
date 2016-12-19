<?php

use Illuminate\Database\Seeder;

class BoycottPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\BoycottPost::class, 150)->create();
    }
}
