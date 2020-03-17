<?php

namespace Tests\Feature;

use App\Show;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $show = factory(Show::class)->create();

        $response = $this->get('/admin/shows/');

        $response->assertStatus(200);
        $response->assertSee($show->title);
    }
}
