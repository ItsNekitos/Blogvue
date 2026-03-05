<template>
    <header id="header">
        <h1><a href="#" @click.prevent="changePage('HomePage')">Blog</a></h1>
        <nav class="main">
            <ul>
                <li class="menu user" v-if="isUser">
                    <a href="#menu"><img :src="PUBLIC + user.avatar" /></a>
                </li>
                <li class="menu" v-else>
                    <a class="fa-user" href="#menu">Menu</a>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'HeaderComponent',
    props: ["isUser", "user", 'changePage', "PUBLIC"],
};
</script>
