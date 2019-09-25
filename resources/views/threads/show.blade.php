@extends('layouts.app')
@section('content')
    <thread-view :initial-replies-count="{{$thread->replies_count}}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="level">
                        <span class="flex">
                            <div class="card-header">{{$thread->id}}
                                <a href="{{route('profile',$thread->creator)}}">
                                    {{$thread->creator->name}}</a> posted: {{ $thread->title}}
                            </div>
                        </span>
                            @can('update', $thread)
                                <span class="flex">
                            <form action="{{$thread->path()}}" method="post">
                                @csrf {{method_field('DELETE')}}
                                <button class="btn btn-link">Delete Thread</button>
                            </form>
                        </span>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        {{$thread->body}}
                    </div>

                    <hr>
                    <replies :data="{{ $thread->replies}}" @added="repliesCount++" @removed="repliesCount--"></replies>
                </div>


                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            This thread published {{ $thread->created_at->diffForHumans()}}
                        </div>
                        <div class="card-body">
                            Created by <a href="/profiles/{{$thread->creator->name}}"> {{$thread->creator->name}}</a>
                            and
                            has <strong><span v-text="repliesCount"></span></strong> comments.

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </thread-view>
@endsection
