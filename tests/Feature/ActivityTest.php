<?php


namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *
     */
    public function testIfActivityIsRecordedWhenThreadIsCreated()
    {
        $this->signIn();

        $thread = create('App\Thread');
        $this->assertDatabaseHas('activities', [
            'type' => 'created_thread',
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => 'App\Thread'
        ]);
    }
}