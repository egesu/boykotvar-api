<?php

use Illuminate\Database\Seeder;

class ConcernsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Concern::class, 50)->create();
    }
}
