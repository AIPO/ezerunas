<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    /**
     * helper to link to /threads/{id}
     * @return string of path to thread
     */
    public function path()
    {
        return '/threads/' . $this->id;
    }
}
