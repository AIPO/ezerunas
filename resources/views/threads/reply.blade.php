<div class="card">
    <div class="card-header">
        <div class="level">
            <h5 class="flex">
                <a href="/profiles/{{$reply->owner->name}}" class="flex">{{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}
            </h5>
            <div>

                <form method="POST" action="/replies/{{$reply->id}}/favorites">
                    @csrf
                <button class="btn btn-default" {{$reply->isFavorited()?'disabled':''}}>
                    {{$reply->favorites_count}}
                </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{$reply->body}}
    </div>
</div>
