<?php

use Illuminate\Database\Seeder;

class ProgrammingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Show::all()->each(function (App\Show $show) {
            foreach (App\Week::all() as $week) {
                $show->programmings()
                    ->create(factory(App\Programming::class)->make([
                        'show_id' => $show->id,
                        'week_id' => $week->id
                    ])->toArray());
            }
        });
    }
}
