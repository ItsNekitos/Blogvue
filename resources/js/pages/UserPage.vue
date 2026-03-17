<template>
    <!-- Main -->
    <div id="main">
        <!-- Post -->
        <article class="post" v-for="value in posts" :key="value">
            <header>
                <div class="title">
                    <h2><a href="#" @click.prevent="changePage('SinglePage', value.id)">{{ value.name }}</a></h2>
                    <p>{{ value.subtile }}</p>
                </div>
                <div class="meta">
                    <time class="published" datetime="2015-11-01">{{ value.created_at.split("T")[0] }}, {{ value.created_at.split(".")[0].split("T")[1] }}</time>
                    <a href="#" class="author"><span class="name">{{ value.user.name }}</span><img :src="PUBLIC + value.user.avatar" alt="" /></a>
                </div>
            </header>
            <a href="#" @click.prevent="changePage('SinglePage', value.id)" class="image featured"><img :src="PUBLIC + value.photo" alt="" /></a>
            <p>
                {{ value.contentt }}
            </p>
            <footer>
                <ul class="actions">
                    <li><a href="#" @click.prevent="changePage('SinglePage', value.id)" class="button big">Continue Reading</a></li>
                </ul>
                <ul class="stats">
                    <li><a class="icon fa-heart">{{ value.likes_count }}</a></li>
                    <li><a class="icon fa-comment">{{ value.comments_count }}</a></li>
                </ul>
            </footer>
        </article>
        
    </div>
</template>
<script>
export default {
    name: 'UserPage',
    props: ['pageId', 'server', 'PUBLIC', 'changePage'],
    data() {
        return {
            posts: [],
        };
    },
    mounted() {
        this.postsUser();
    },
    methods: {
        postsUser() {
            this.server('postsUser/' + this.pageId)
                .then((result) => {
                    this.posts = result;
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
