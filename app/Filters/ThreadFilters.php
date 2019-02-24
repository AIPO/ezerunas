<?php
namespace App\Filters;

use App\User;
use Illuminate\Http\Request;
use App\Filters\Filters;

class ThreadFilters extends Filters
{
    protected $filters =['by'];

    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }
}
