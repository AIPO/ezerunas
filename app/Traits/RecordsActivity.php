<?php


namespace App\Traits;


use ReflectionClass;
use ReflectionException;

trait RecordsActivity
{

    protected static function bootRecordsActivity()
    {
        if(auth()->guest())return;

        static::created(function ($thread) {
            $thread->recordActivity('created');
        });
    }

    /**
     * @return mixed
     */
    public function activity()
    {
        return $this->morphMany('App\Activity', 'subject');
    }

    /**
     * @param $event
     * @throws ReflectionException
     */
    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event)]);
    }

    /**
     * @param $event
     * @return string
     * @throws ReflectionException
     */
    protected function getActivityType($event)
    {
        $type = strtolower((new ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";

    }
}