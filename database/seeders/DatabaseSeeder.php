<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Programming;
use App\Models\Show;
use App\Models\Week;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory()->state([
            'email' => 'test@' . config('app.domain'),
            'password' => Hash::make('password'),
        ])->create();

        $this->call([
            WeekSeeder::class,
            ShowSeeder::class,
            ProgrammingShowingSeeder::class,
        ]);

    }
}
