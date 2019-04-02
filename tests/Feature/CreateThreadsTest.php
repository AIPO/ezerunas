<?php

namespace Tests\Feature;

use App\Channel;
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
        $response = $this->post('/threads', $thread->toArray());
        //dd($thread->path());
        $this->get($response->headers->get('Location'))
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
    public function test_a_thread_requires_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors(['title']);
    }
    public function test_a_thread_requires_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors(['body']);
    }
    public function test_a_thread_requires_channel_id()
    {
        factory(Channel::class, 2)->create();
        $this->publishThread(['channel_id' => null])->assertSessionHasErrors(['channel_id']);
        $this->publishThread(['channel_id' => 2])->assertSessionHasErrors(['channel_id']);
    }
    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling();
        $this->expectException('Illuminate\Validation\ValidationException');
        $this->signIn();

        $thread = make(Thread::class, $overrides);
        //dd($thread);

        return $this->post('/threads', $thread->toArray());
    }
    public function testThreadCanBeDeletedWithReplies()
    {
        $this->signIn();
        $thread = create(Thread::class);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);
        $response = $this->json('DELETE', $thread->path());
        $response->asserStatus(204);
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }
    /** @test */
    public function testGuestsCanNotDeleteThreads()
    {
        $thread = create(Thread::class);
        $response = $this->delete($thread->path());
        $response->assertRedirect('/login');
    }

}
