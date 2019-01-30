<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthenticatedUserCanParticipateInForumThreads()
    {
        // user is authenticated
        $this->signIn();
        $thread = create(Thread::class);
        $reply = make(Reply::class);
        $this->post($thread->path() . '/replies', $reply->toArray());
        //on threads/thread id see reply
        $this->get($thread->path())->assertSee($reply->body);
    }

    /**
     *
     */
    public function testUnauthenticatedUsersMayNotAddReplies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('threads/some-channel/1/replies', []);
    }
}
