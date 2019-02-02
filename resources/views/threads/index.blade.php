@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @foreach($threads as $thread)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{$thread->path()}}">{{$thread->title}}</a>
                            </h4>
                            <div class="card-text">{!!$thread->body!!}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
