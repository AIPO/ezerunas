<?php

use Illuminate\Database\Seeder;
use App\Thread;
use App\Reply;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $threads = factory(Thread::class, 50)->create();
        $threads->each(function ($thread) {
            factory(Reply::class, 10)->create(['thread_id' => $thread->id]);
        }
        );
    }
}
