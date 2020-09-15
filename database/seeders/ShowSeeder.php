<?php

namespace Database\Seeders;

use App\Models\Show;
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
        Show::factory()
            ->count(15)
            ->hasVideos(1, ['is_original_version' => true])
            ->hasVideos(1, ['is_original_version' => false])
            ->create();
    }
}
