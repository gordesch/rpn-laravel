<?php

namespace Database\Seeders;

use App\Models\Programming;
use App\Models\Show;
use App\Models\Week;
use Illuminate\Database\Seeder;

class ProgrammingShowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Show::all()->each(function (Show $show) {
            foreach (Week::all() as $week) {
                Programming::factory()
                    ->hasShowings(50)
                    ->create([
                        'week_id' => $week->id,
                    ]);
            }
        });
    }
}
