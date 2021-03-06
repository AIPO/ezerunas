<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($channelId, Thread $thread)
    {
      return $thread->replies()->paginate(6);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $channelId
     * @param Thread $thread
     * @return \Illuminate\Database\Eloquent\Model
     * @throws ValidationException
     */
    public function store($channelId, Thread $thread)
    {
        $this->validate(
            request(),
            ['body' => 'required']
        );
        $reply=$thread->addReply(
            [
                'body' => \request('body'),
                'user_id' => auth()->id()
            ]
        );
        if (request()->expectsJson()) {
            return $reply->load('owner');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        //  dd($request);
        $reply->update(['body' =>request('body')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->delete();
        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted!']);
        }
        session()->flash('message', 'Reply was deleted!');
        return back();
    }
}
