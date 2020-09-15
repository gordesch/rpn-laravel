<?php

namespace Database\Seeders;

use App\Models\Programming;
use App\Models\Show;
use App\Models\Showing;
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
        Show::all()->each(function (Show $show) {
            $show->programmings->each(function (Programming $programming) {
                Showing::factory()->count(50)->create([
                    'programming_id' => $programming->id
                ]);
            });
        });
    }
}
