<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthenticatedUserCanCreateNewForumThreads()
    {
        //Create user
        $this->signIn();
        $thread = factory(Thread::class)->make();
        $this->post('/threads', $thread->toArray());
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /**
     */
    public function testGuestsMayNotCreateThreads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = make(Thread::class);
        $this->post('/threads', $thread->toArray());
    }
}
