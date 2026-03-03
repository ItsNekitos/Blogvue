<template>
    <!-- Main -->
    <div id="main">
        <!-- Post -->
        <article class="post">
            <h1>Add Post</h1>
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
            <input v-model="photo" type="file" /><br /><br />
            <p class="red" v-if="errors.photo">
                {{ errors.photo.join('. ') }}
            </p>
            <input type="submit" class="button big fit" value="Add Post" />
        </article>
    </div>
</template>
<script>
export default {
    name: 'PostAdd',
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
    methods: {},
};
</script>
