<div class="card">
    <div class="card-header bg-success">
        <a href="#">{{$reply->owner->name}}</a>   said
        {{$reply->created_at->diffForHumans()}}
    </div>

    <div class="card-body">
        {{$reply->body}}
    </div>
</div>