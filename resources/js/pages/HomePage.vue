<template>
    <!-- Main -->
    <div id="main">
        <!-- Post -->
        <template v-for="post in posts.data">
            <PostComponent :post="post" :changePage="changePage" />
        </template>

        <!-- Pagination -->
        <ul class="actions pagination">
            <li><a href="" class="disabled button big previous">Previous Page</a></li>
            <li><a href="#" class="button big next">Next Page</a></li>
        </ul>
    </div>

    <!-- Sidebar -->
    <SidebarComponent />
</template>
<script>
import PostComponent from '@/components/PostComponent.vue';
import SidebarComponent from '@/components/SidebarComponent.vue';

export default {
    name: 'HomePage',
    props: ['server', 'changePage', 'pageId', 'PUBLIC'],
    components: {
        PostComponent,
        SidebarComponent,
    },
    data() {
        return {
            posts: [],
        };
    },
    mounted() {
        this.postsHome();
    },
    methods: {
        postsHome() {
            this.server('postsHome')
                .then((result) => {
                    this.posts = result;
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
