<?php

use Illuminate\Database\Seeder;

class BoycottsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Boycott::class, 30)->create()->each(function($boycott) {
            factory(App\Model\Media::class)->create([
                'related_id' => $boycott->id,
                'related_to' => 'boycott_cover_image',
            ]);

            factory(App\Model\BoycottConcern::class, rand(1, 5))->create([
                'boycott_id' => $boycott->id,
                'concern_id' => App\Model\Concern::inRandomOrder()->first()->id,
            ]);
        });
    }
}
