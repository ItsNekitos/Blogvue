<template></template>
<script>
export default {
    name: 'UserPage',
    props: ['pageId', 'server', 'PUBLIC', 'changePage'],
    data() {
        return {
            posts: []
        };
    },
    mounted() {
        this.postUser();
    },
    methods: {
        postUser() {
            this.server('postUser/' + this.pageId)
                .then((result) => {
                    this.posts = result;
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>