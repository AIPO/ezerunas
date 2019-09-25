<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Channel;
use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiTestRepliesTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_replies_are_returned_to_thread()
    {
        $thread= create(Thread::class);
        create(Reply::class, ['thread_id' => $thread->id], 2);
        $response = $this->getJson($thread->path().'/replies')->json();
    //    dd($response);
        $this->assertCount(1, $response['data']);
        $this->assertEquals(2, $response['total']);
    }
}
