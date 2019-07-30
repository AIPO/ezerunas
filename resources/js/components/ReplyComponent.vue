<template>
<div :id="'reply-'+id" class="card">
    <div class="card-header">
        <div class="level">
            <h5 class="flex">
                <a :href="'/profiles/'+data.owner.name" class="flex" v-text="data.owner.name"></a> said
                {{data.created_at}}
            </h5>
            <!-- @if (Auth::check())
            <div>
                <favorite :reply="{{$reply}}"></favorite>
            </div>
            @endif -->
        </div>
    </div>
    <div class="card-body">
        <div v-if="editing">
            <div class="form-group">
                <textarea class="form-control" v-model="body"></textarea>
            </div>
            <div class="btn-group btn-group-sm">
                <button class="btn btn-primary" @click="update">Update</button>
                <button class="btn btn-link" @click="editing=false">Cancel</button>
            </div>
        </div>
        <div v-else v-text="body">
        </div>

    </div>
    <div class="card-footer">
        <div class="form-group level">
            <button class="btn btn-sm btn-outline-primary mr-1" @click="editing=true">Edit</button>
            <button class="btn btn-sm btn-outline-danger mr-1" @click="destroy">Delete</button>
        </div>
    </div>

</div>
</template>
<script>
import Favorite from './FavoriteComponent.vue';
export default {
    props: ['data'],
    components: {
        Favorite
    },
    data() {
        return {
            id: this.data.id,
            editing: false,
            body: this.data.body
        };
    },

    methods: {
        update() {
            axios.patch('/replies/' + this.data.id, {
                body: this.body
            });
            this.editing = false;
            flash('Updated!');
        },
        destroy() {
            axios.delete('/replies/' + this.data.id);
            this.$emit('deleted', this.data.id)
        }
    },
}
</script>
