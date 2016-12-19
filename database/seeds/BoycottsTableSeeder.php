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
        factory(App\Boycott::class, 30)->create()->each(function($boycott) {
            factory(App\Media::class)->create([
                'related_id' => $boycott->id,
                'related_to' => 'boycott_cover_image',
            ]);
        });
    }
}
