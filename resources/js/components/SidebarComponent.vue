<template>
    <!-- Mini Post -->
    <article class="mini-post">
        <header>
            <h3>
                <a href="#">{{ post.name }}</a>
            </h3>
            <time class="published" datetime="2015-10-20">{{ post.created_at.split("T")[0] }}, {{ post.created_at.split(".")[0].split("T")[1] }}</time>
            <a href="#" @click.prevent="changePage('UserPage', post.user.id)" class="author"><img :src="PUBLIC + post.user.avatar" alt="" /></a>
        </header>
        <a href="#" @click.prevent="changePage('SinglePage', post.id)" class="image"><img :src="PUBLIC + post.photo" alt="" /></a>
    </article>
</template>

<script>
export default {
    name: 'SidebarComponent',
    props: ['post', 'PUBLIC', 'changePage'],
};
</script>
