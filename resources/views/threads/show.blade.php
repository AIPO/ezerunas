@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary">
                    <a href="#">{{$thread->creator->name}}</a> posted: {{ $thread->title }}
                </div>

                <div class="card-body">
                    {{$thread->body}}
                </div>
            </div>
            <hr> @foreach ($replies as $reply)
    @include('threads.reply') @endforeach {{$replies->links()}} @if(auth()->check())
            <form method="POST" action="{{$thread->path().'/replies'}}">
                @csrf
                <div class="form-group">
                    <label for="body">Reply</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="Have something to say?"></textarea>
                </div>
                <button type="submit" class="btn">Post</button>
            </form>
            @else
        <p class="text-center">Please <a href="{{route('login')}}">sign in</a> to reply to a post</p>
        @endif
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary">
                    This thread published {{ $thread->created_at->diffForHumans()}}
                </div>
                <div class="card-body">
                    Created by <a href="/profiles/{{$thread->creator->name}}"> {{$thread->creator->name}}</a> and has <strong>{{$thread->replies_count}}</strong>                    comments.

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
