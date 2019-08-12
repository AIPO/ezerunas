<template>
  <div>
    @if(auth()->check())
        <!-- <form method="POST" action="{{$thread->path().'/replies'}}"> -->
            <!-- @csrf -->
            <div class="form-group">
                <label for="body">Reply</label>
                <textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="Have something to say?"></textarea>
            </div>
            <button type="submit" class="btn">Post</button>
        <!-- </form> -->
        @else
        <p class="text-center">Please <a href="{{route('login')}}">sign in</a> to reply to a post</p>
        @endif
  </div>
</template>

<script>
export default {

}
</script>
