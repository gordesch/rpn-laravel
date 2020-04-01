<?php


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
        \App\Admin::create([
            'email' => 'test@' . config('app.domain'),
            'password' => Hash::make('password'),
        ]);
        $this->call(WeekSeeder::class);
        $this->call(ShowSeeder::class);
        $this->call(ProgrammingSeeder::class);
        $this->call(ShowingSeeder::class);
    }
}
