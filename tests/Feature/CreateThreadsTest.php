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
        $thread = create(Thread::class);
        $this->post('/threads', $thread->toArray());
        //dd($thread->path());
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /**
     */
    public function testGuestsMayNotCreateThreads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads')->assertRedirect('/login');
        $this->get('/threads/create')->assertRedirect('/login');
    }
}
