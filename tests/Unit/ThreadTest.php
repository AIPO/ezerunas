<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
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
    public function testHasReplies()
    {
        $this->assertInstanceOf(Collection::class, $this->thread->replies);

    }

    public function testThreadHasCreator()
    {
        $this->assertInstanceOf(User::class, $this->thread->creator);
    }

    public function testThreadCanAddReply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);
        $this->assertCount(1, $this->thread->replies);
    }
}
