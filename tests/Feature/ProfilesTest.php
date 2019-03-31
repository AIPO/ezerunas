<?php
namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;
    public function testUserHasProfile()
    {
        $user = create(User::class);
        $this->get("/profiles/{$user->name}")->assertSee($user->name);
    }
    public function testProfilesDisplayAllthreadsCreatedByUser()
    {
        $user = create(User::class);
        $thread = create(Thread::class, ['user_id' => $user->id]);
        $this->get("/profiles/{$user->name}")->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
