<template>
    <div>
        <div v-if="true">
            <div class="form-group">
                <label for="body">Reply</label>
                <textarea id="body" name="body" rows="10" class="form-control" placeholder="Have something to say?"
                          v-model="body"
                          required></textarea>
            </div>
            <button type="submit" class="btn" @click="addReply">
                Post
            </button>
        </div>
        <p class="text-center" v-else>Please <a href="/login">sign in</a> to reply to a post</p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: "",
                endpoint: '/threads/modi/1/replies'
            }
        },
        methods: {
            addReply() {
                axios.post(this.endpoint, {
                    body: this.body
                })
                    .then(response => {
                        this.body = ""; //reset body to empty string
                        flash("Your reply has been posted!");
                        this.$emit('created', response.data);
                    })
            }
        }
    }
</script>
