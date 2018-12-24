@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary">
                        <a href="#">{{$thread->creator->name}}</a> posted:
                        {{ $thread->title }}
                    </div>

                    <div class="card-body">
                        {{$thread->body}}
                    </div>
                </div>
                <hr>
                @foreach ($thread->replies as $reply)
                    @include('threads.reply')
                    <br>
                @endforeach
            </div>
        </div>
        @if(auth()->check())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="{{$thread->path().'/replies'}}">
                        @csrf
                        <div class="form-group">
                            <label for="body">Reply</label>
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control"
                                      placeholder="Have something to say?"></textarea>
                        </div>
                        <button type="submit" class="btn">Post</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center">Please <a href="{{route('login')}}">sign in</a> to reply to a post</p>
        @endif
    </div>
@endsection