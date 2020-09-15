<?php

namespace Database\Seeders;

use App\Models\Week;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Gordesch\CineCarbon;
use Illuminate\Database\Seeder;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weeks = CarbonPeriod::since(Carbon::now())
                             ->weeks(1)
                             ->until(Carbon::now()->addWeeks(3))
                             ->setDateClass(CineCarbon::class);
        foreach ($weeks as $week) {
            Week::factory()->create(['number' => $week->programmingWeek()]);
        }
    }
}
