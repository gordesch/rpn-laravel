<?php

namespace Tests\Unit;

use App\Models\Programming;
use App\Models\Show;
use App\Models\Showing;
use App\Models\Video;
use Carbon\CarbonInterval;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCanSetDurationAttribute()
    {
        $show = new Show();
        $duration_in_seconds = 60 * 75;
        $show->duration = CarbonInterval::seconds($duration_in_seconds);
        $this->assertEquals($duration_in_seconds, $show->duration->totalSeconds);
    }

    public function testHasPages()
    {
        $show = factory(Show::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $show->pages);
    }

    public function testHasProgrammings()
    {
        $show = factory(Show::class)->create();
        $programming = factory(Programming::class)->create(['show_id' => $show->id]);
        $this->assertTrue($show->programmings->contains($programming));
    }

    public function testHasShowings()
    {
        $show = factory(Show::class)->create();
        $programming = factory(Programming::class)->create(['show_id' => $show->id]);
        $showing = factory(Showing::class)->create(['programming_id' => $programming->id]);
        $this->assertTrue($show->showings->contains($showing));
    }

    public function testHasVideos()
    {
        $show = factory(Show::class)->create();
        $video = factory(Video::class)->create(['show_id' => $show->id]);
        $this->assertTrue($show->videos->contains($video));
    }
}
