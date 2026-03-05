<template>
    <!-- Main -->
    <div id="main">
        <!-- Post -->
        <article class="post">
            <header>
                <div class="title">
                    <h2>
                        <a href="#">{{ post.name }}</a>
                    </h2>
                    <p>{{ post.subtitle }}</p>
                </div>
                <div class="meta">
                    <time class="published" datetime="2015-11-01">{{ post.created_at }}</time>
                    <a href="#" class="author"
                        ><span class="name">{{ post.user.name }}</span
                        ><img :src="PUBLIC + post.user.avatar" alt=""
                    /></a>
                </div>
            </header>
            <span class="image featured"><img :src="PUBLIC + post.photo" alt="" /></span>
            <p>
                {{ post.anons }}
            </p>
            <p>
                {{ post.contentt }}
            </p>
            <footer>
                <ul class="stats">
                    <li><a href="#">Edit</a></li>
                    <li><a href="#" class="red">Delete</a></li>
                    <li><a href="#" class="red">Blocked</a></li>
                    <li><a href="#" class="icon fa-heart">28</a></li>
                    <li><a href="#" class="icon fa-comment">128</a></li>
                </ul>
            </footer>
        </article>

        <!-- Comments -->
        <div class="post">
            <section class="comments">
                <h3>Comments</h3>
                <form>
                    <textarea></textarea><br />
                    <input type="submit" class="button big fit" value="Add Comment" />
                </form>
            </section>
            <article class="comment">
                <div class="comment-autor">
                    <a href="#"><img src="images/avatar.jpg" /></a>
                    <a href="#">User</a>
                </div>
                <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat.</p>
            </article>
        </div>
    </div>
</template>
<script>
export default {
    name: 'SinglePage',
    props: ['pageId', 'server', 'PUBLIC'],
    data() {
        return {
            post: {},
        };
    },
    mounted() {
        this.server('post/' + this.pageId)
            .then((result) => {
                this.post = result;
            })
            .catch((error) => console.log('error', error));
    },
};
</script>
