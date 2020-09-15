<?php

namespace Tests\Unit;

use App\Models\Show;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testHasShow()
    {
        $show = factory(Show::class)->create();
        $video = factory(Video::class)->create(['show_id' => $show->id]);
        $this->assertInstanceOf(Show::class, $video->show);
    }
}
