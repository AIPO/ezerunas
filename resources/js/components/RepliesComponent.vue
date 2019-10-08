<template>
<div>
    <div v-for="(reply,index) in items" :key="reply.id">
        <reply :data="reply" @deleted="remove(index)"></reply>
    </div>
    <br>
    <paginator :dataSet="dataSet" @changed="fetch"></paginator>
    <new-reply @created="add"></new-reply>
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
        }
    },
    created() {
        this.fetch();
    },
    methods: {
        url(page) {
            if (!page) {
                let query = location.search.match(/page=(\d+)/);
        page = query ? query[1] : 1;
    }
    return location.pathname + '/replies?page=' + page;
    //inline `${location.pathname}/replies`;
},
fetch(page) {
        axios.get(this.url(page))
            .then(this.refresh);
    },
    refresh({
        data
    }) {
        this.dataSet = data;
        this.items = data.data;
        window.scrollTo(0,0);
    }
}
}
</script>

<style lang="css" scoped>
</style>
