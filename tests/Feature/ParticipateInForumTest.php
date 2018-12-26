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
        $this->be($user = factory(User::class)->create());
        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make();
        $this->post('/threads/' . $thread->id . '/replies', $reply->toArray());
        //on threads/thread id see reply
        $this->get($thread->path())->assertSee($reply->body);
    }

    /**
     *
     */
    public function testUnauthenticatedUsersMayNotAddReplies()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('threads/1/replies', []);
    }
}
