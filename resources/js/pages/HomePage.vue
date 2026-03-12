<template>
    <!-- Main -->
    <div id="main">
        <!-- Post -->
        <template v-for="post in posts.data">
            <PostComponent :post="post" :changePage="changePage" :PUBLIC="PUBLIC" :likeArray="likeArray" />
        </template>

        <!-- Pagination -->
        <ul class="actions pagination">
            <li><a href="#" @click.prevent="postsHome(posts.current_page - 1)" :class="{disabled: posts.current_page==1}" class="button big previous">Previous Page</a></li>
            <li><a href="#" @click.prevent="postsHome(posts.current_page + 1)" :class="{disabled: posts.current_page==posts.last_page}" class="button big next">Next Page</a></li>
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
    props: ['server', 'changePage', 'PUBLIC', 'user'],
    components: {
        PostComponent,
        SidebarComponent,
    },
    data() {
        return {
            posts: [],
            likeArray: [],
        };
    },
    mounted() {
        this.postsHome();
    },
    methods: {
        postsHome(page = 1) {
            this.server('postsHome/?page='+page, 'GET', null, this.user.id)
                .then((result) => {
                    this.posts = result.posts;
                    this.likeArray = result.likeArray;
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
