<template>
    <!-- Main -->
    <div id="main" v-if="post">
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
                    <time class="published">{{ post.created_at.split('T')[0] }}, {{ post.created_at.split('.')[0].split('T')[1] }}</time>
                    <a href="#" @click.prevent="changePage('UserPage', post.user_id)" class="author"
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
                    <li v-if="isAdmin"><a href="#" @click.prevent="changePage('PostAdd', post.id)">Edit</a></li>
                    <li v-if="isAdmin"><a href="#" class="red">Delete</a></li>
                    <li v-if="isAdmin"><a href="#" class="red">Blocked</a></li>
                    <li>
                        <a href="#" @click.prevent="likeClick" class="icon fa-heart" :class="{ liked: isLike }">{{ post.likes_count }}</a>
                    </li>
                    <li>
                        <a href="#countblock" class="icon fa-comment">{{ post.comments_count }}</a>
                    </li>
                </ul>
            </footer>
        </article>

        <!-- Comments -->
        <div class="post" id="countblock">
            <section class="comments" v-if="isUser">
                <h3>Comments</h3>
                <div>
                    <textarea v-model="comment"></textarea><br />
                    <p class="red" v-if="errors.comment">
                        {{ errors.comment.join('. ') }}
                    </p>
                    <button type="button" @click="addComment" class="button big fit">Добавить комментарий</button>
                </div>
            </section>
            <article class="comment" v-for="value in comments">
                <div class="comment-autor">
                    <a href="#" @click.prevent="changePage('UserPage', value.user_id)"><img :src="PUBLIC + value.user.avatar" /></a>
                    <a href="#" @click.prevent="changePage('UserPage', value.user_id)">{{ value.user.name }}</a>
                </div>
                <p>{{ value.comment }}</p>
            </article>
        </div>
    </div>
</template>
<script>
export default {
    name: 'SinglePage',
    props: ['pageId', 'server', 'PUBLIC', 'changePage', 'isUser'],
    data() {
        return {
            post: null,
            comments: [],
            comment: null,
            errors: {},
            isAdmin: false,
            isLike: false,
        };
    },
    mounted() {
        this.postUser();
    },
    methods: {
        likeClick() {
            if (!this.isUser) {
                alert('Авторизируйтесь!!!');
            } else {
                this.server('like/' + this.pageId)
                    .then((result) => {
                        this.post.likes_count = result.like_count;
                        this.isLike = result.isLike;
                    })
                    .catch((error) => console.log('error', error));
            }
        },
        postUser() {
            this.server((this.isUser ? 'postUser/' : 'post/') + this.pageId)
                .then((result) => {
                    this.post = result.post;
                    this.comments = result.comments;
                    this.isAdmin = result.isAdmin;
                    this.isLike = result.isLike;
                })
                .catch((error) => console.log('error', error));
        },
        addComment() {
            let formdata = new FormData();
            if (this.comment) formdata.append('comment', this.comment);
            this.server('comment/' + this.pageId, 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    } else {
                        this.postUser();
                        this.comment='';
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
