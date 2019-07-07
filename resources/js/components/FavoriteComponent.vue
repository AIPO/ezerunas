<template>
<button class="btn btn-default" @click="toggle">
    <span class="fas fa-heart"></span>
    <span v-text="favoritesCount"> </span>
</button>
</template>
<script>
export default {
    props: ['reply'],
    data() {
        return {
            favoritesCount: 1,

        }
    },
    methods: {
        toggle() {
            if (this.isFavorited) {
                axios.delete('replies/'+this.reply.id+'/favorites');
            }else{
                axios.create('replies/'+this.reply.id+'/favorites');
            }
        }
    }
}
</script>
