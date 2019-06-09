@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{$profileUser->name}}
                <small> prisijungė {{$profileUser->created_at->diffForHumans()}}</small>
            </h1>
        </div>
        <div>
            <ul class="list-group">
                @foreach($activities as $date =>$activity)
                    <h3 class="page-header">{{dd($date)}}</h3>
                    @foreach($activity as $record)
                        @include("profiles.activities.{$record->type}",['activity'=> $record])
                        {{--                    <li class="list-group-item list-group-item-primary">A simple primary list group item</li>--}}
                        {{--                    <li class="list-group-item list-group-item-secondary">A simple secondary list group item</li>--}}
                        {{--                    <li class="list-group-item list-group-item-success">A simple success list group item</li>--}}
                        {{--                    <li class="list-group-item list-group-item-danger">A simple danger list group item</li>--}}
                        {{--                    <li class="list-group-item list-group-item-warning">A simple warning list group item</li>--}}
                        {{--                    <li class="list-group-item list-group-item-info">A simple info list group item</li>--}}
                        {{--                    <li class="list-group-item list-group-item-light">A simple light list group item</li>--}}
                        {{--                    <li class="list-group-item list-group-item-dark">A simple dark list group item</li>--}}
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>

@endsection
