<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanBrowseThreadsTest()
    {
        $thread = factory(Thread::class)->create();
        $response = $this->get('/threads');

        $response->assertStatus(200);
        $response->assertSee($thread->title);

    }

    public function testUserCanSeeThread()
    {
        $thread = factory(Thread::class)->create();
        $response = $this->get('/threads/' . $thread->id);
        $response->assertStatus(200);
        $response->assertSee($thread->title);
    }
}
