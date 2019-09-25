<template>
<div>
    <div v-for="(reply,index) in items" :keys="reply.id">
        <reply :data="reply" @deleted="remove(index)"></reply>
    </div>
    <new-reply :endpoint="endpoint" @created="add"></new-reply>
</div>
</template>

<script>
import Reply from './ReplyComponent.vue';
import NewReply from './NewReplyComponent.vue';
import collection from '../mixins/collection.js';

export default {
    components: {
        Reply,
        NewReply
    },
    mixins: [collection],
    data() {
        return {
            dataSet: false,
            endpoint: location.pathname + '/replies'
        }
    },
    created() {
        this.fetch();
    },
    methods: {
        url() {
            return location.pathname + '/replies';
        },
        fetch() {
            axios.get(this.url())
                .then(this.refresh);
        },
        refresh({
            data
        }) {
            this.dataSet = data;
            this.items = data.data;
        }
    }
}
</script>

<style lang="css" scoped>
</style>
