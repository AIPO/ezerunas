<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
        parent::setUp();
        $this->thread = factory(Thread::class)->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanBrowseThreadsTest()
    {

        $response = $this->get('/threads');

        $response->assertStatus(200);
        $response->assertSee($this->thread->title);

    }

    public function testUserCanSeeThread()
    {
        $this->get('/threads/' . $this->thread->id)
            ->assertStatus(200)
            ->assertSee($this->thread->title);
    }

    public function testUserCanReadRepliesPerThread()
    {
        $reply = factory(Reply::class)
            ->create(['thread_id' => $this->thread->id]);
        $this->get('/threads/' . $this->thread->id)
            ->assertSee($reply->body);
    }
}
