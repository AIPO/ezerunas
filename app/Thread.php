<?php

namespace App;

use App\Filters\ThreadFilters;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Thread extends Model
{
    protected $guarded = [];
    protected $fillable = ['title', 'channel_id', 'user_id', 'body'];
    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });
        static::deleting(function ($thread) {
            $thread->replies()->delete();
        });
        static::created(function ($thread) {
            Activity::create(
                [
                    'user_id' => auth()->id(),
                    'type' => 'created_thread',

                ]
            );
        });
    }

    /**
     * helper to link to /threads/{id}
     * @return string of path to thread
     */
    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * @param  array $reply
     * @return Reply
     */
    public function addReply($reply)
    {
        return   $this->replies()->create($reply);
    }

    public function scopeFilter($query, ThreadFilters $filters)
    {
        return $filters->apply($query);
    }

    public function getReplyCount()
    {
        $this->replies()->count();
    }
}
