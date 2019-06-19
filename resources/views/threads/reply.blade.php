<reply inline-templete>
    <div id="reply-{{$reply->id}}" class="card">
        <div class="card-header">
            <div class="level">
                <h5 class="flex">
                    <a href="/profiles/{{$reply->owner->name}}" class="flex">{{$reply->owner->name}}</a> said
                    {{$reply->created_at->diffForHumans()}}
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
            <div v-if="editing">
                <textarea name="" id="" cols="30" rows="10"></textarea>
            </div>
            <div v-else>
                {{$reply->body}}
            </div>

        </div>
        @can('update', $reply)
        <div class="card-footer level">
            <button type="submit" class="btn btn-sm mr-1" @click="editing = true">Edit</button>
            <form method="POST" action="/replies/{{$reply->id}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
        @endcan
    </div>
</reply>
