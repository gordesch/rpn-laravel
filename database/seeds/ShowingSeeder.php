<?php

use App\Show;
use Illuminate\Database\Seeder;

class ShowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Show::all()->each(function (App\Show $show) {
            $show->programmings->each(function (App\Programming $programming) {
                $programming
                    ->showings()
                    ->createMany(
                        factory(App\Showing::class, 50)->make([
                            'programming_id' => $programming->id,
                        ])->toArray()
                    );
            });
        });
    }
}
