<?php

namespace Tests\Feature;

use App\User;
use App\Reply;
use App\Thread;
use App\Channel;
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
        $this->thread = create(Thread::class);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanBrowseThreadsTest()
    {
        $this->get('/threads')->assertStatus(200)->assertSee($this->thread->title);
    }

    public function testUserCanSeeThread()
    {
        $this->get($this->thread->path())
            ->assertStatus(200)
            ->assertSee($this->thread->title);
    }

    public function testUserCanReadRepliesPerThread()
    {
        $reply = create(Reply::class, ['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }
    public function test_user_can_filter_threads_according_to_channel()
    {
        $channel = create(Channel::class);
        $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $threadNotInChannel= create(Thread::class);
        $this->get('/threads/'. $channel->slug)
        ->assertSee($threadInChannel->title)
        ->assertDontSee($threadNotInChannel);
    }
    public function test_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create(User::class, ['name'=>'JohnDoe']));
        $threadByJohn = create(Thread::class, ['user_id' => auth()->id()]);
        $threadbyNotJohn = create(Thread::class);
        $this->get('threads?by=JohnDoe')
        ->assertSee($threadByJohn->title)
        ->assertDontSee($threadbyNotJohn->title);
    }
}
