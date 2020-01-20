<?php

use Illuminate\Database\Seeder;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Show::class, 15)->create()->each(function (App\Show $show) {
            $show->videos()->create(factory(App\Video::class)->make([
                'show_id' => $show->id,
                'is_original_version' => true
            ])->toArray());
            $show->videos()->create(factory(App\Video::class)->make([
                'show_id' => $show->id,
                'is_original_version' => false
            ])->toArray());
        });
    }
}
