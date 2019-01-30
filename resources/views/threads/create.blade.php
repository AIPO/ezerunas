@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('thread.create')</div>
                    <div class="card-body">
                        <form method="post" action="/threads">
                            @csrf
                            <div class="form-group">
                                <label for="title">@lang('thread.title')</label>
                                <input type="text" class="form-control"  placeholder="@lang('thread.placeholder')" name="title">
                            </div>
                            <div class="form-group">
                                <label for="body">@lang('thread.body')</label>
                                <textarea class="form-control" name="body" id="editor"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">@lang('thread.submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection