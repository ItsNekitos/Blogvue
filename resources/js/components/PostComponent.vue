<template>
        <article class="post">
            <header>
                <div class="title">
                    <h2><a href="#" @click.prevent="changePage('SinglePage', post.id)">{{ post.name }}</a></h2>
                    <p>{{ post.subtile }}</p>
                </div>
                <div class="meta">
                    <time class="published" datetime="2015-11-01">{{ post.created_at }}</time>
                    <a href="#" class="author"><span class="name">{{ post.user.name }}</span><img :src="PUBLIC + post.user.avatar" alt="" /></a>
                </div>
            </header>
            <a href="#" @click.prevent="changePage('SinglePage', post.id)" class="image featured"><img :src="PUBLIC + post.photo" alt="" /></a>
            <p>
                {{ post.contentt }}
            </p>
            <footer>
                <ul class="actions">
                    <li><a href="#" @click.prevent="changePage('SinglePage', post.id)" class="button big">Continue Reading</a></li>
                </ul>
                <ul class="stats">
                    <li><a href="#" class="icon fa-heart">{{ post.likes_count }}</a></li>
                    <li><a href="#" class="icon fa-comment">{{ post.comments_count }}</a></li>
                </ul>
            </footer>
        </article>
</template>

<script>
export default {
    name: 'PostComponent',
    props: ['post'],
};
</script>
