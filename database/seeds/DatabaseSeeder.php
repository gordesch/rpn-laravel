<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(WeekSeeder::class);
        $this->call(ShowSeeder::class);
        $this->call(ProgrammingSeeder::class);
        $this->call(ShowingSeeder::class);
    }
}
