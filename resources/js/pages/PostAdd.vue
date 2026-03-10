<template>
    <!-- Main -->
    <div id="main">
        <!-- Post -->
        <article class="post">
            <h1>{{ pageId ? 'Редактировать' : 'Добавить' }} пост</h1>
            <input type="text" v-model="name" placeholder="Post name" /><br />
            <p class="red" v-if="errors.name">
                {{ errors.name.join('. ') }}
            </p>
            <input type="text" v-model="subtitle" placeholder="Subtitle" /><br />
            <p class="red" v-if="errors.subtitle">
                {{ errors.subtitle.join('. ') }}
            </p>
            <input type="text" v-model="anons" placeholder="Anons" /><br />
            <p class="red" v-if="errors.anons">
                {{ errors.anons.join('. ') }}
            </p>
            <textarea placeholder="Post content" v-model="contentt"></textarea><br />
            <p class="red" v-if="errors.contentt">
                {{ errors.contentt.join('. ') }}
            </p>
            <input type="file" id="photo" /><br /><br />
            <p class="red" v-if="errors.photo">
                {{ errors.photo.join('. ') }}
            </p>
            <button type="button" @click="postadd" class="button big fit">{{ pageId ? 'Редактировать' : 'Добавить' }} пост</button>
        </article>
        <div v-if="pageId">
            <img :src="PUBLIC + photo" alt="" />
        </div>
    </div>
</template>
<script>
export default {
    name: 'PostAdd',
    props: ['server', 'changePage', 'pageId', 'PUBLIC'],
    data() {
        return {
            name: null,
            subtitle: null,
            anons: null,
            contentt: null,
            photo: null,
            errors: {},
        };
    },
    mounted() {
        if (this.pageId) {
            this.getPost();
        }
    },
    methods: {
        getPost() {
            this.server('post/' + this.pageId)
                .then((result) => {
                    this.name = result.post.name;
                    this.subtitle = result.post.subtitle;
                    this.anons = result.post.anons;
                    this.contentt = result.post.contentt;
                    this.photo = result.post.photo;
                })
                .catch((error) => console.log('error', error));
        },
        postadd() {
            let formdata = new FormData();
            if (this.name) formdata.append('name', this.name);
            if (this.subtitle) formdata.append('subtitle', this.subtitle);
            if (this.anons) formdata.append('anons', this.anons);
            if (this.contentt) formdata.append('contentt', this.contentt);
            let photo = document.querySelector('#photo');
            if (photo.files[0]) {
                formdata.append('photo', photo.files[0]);
            }
            this.server(this.pageId ? 'postedit/' + this.pageId : 'postadd', 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    }

                    if (result.id) {
                        this.changePage('SinglePage', result.id);
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
