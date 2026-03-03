<template>
    <section id="menu">
        <!-- Actions -->
        <section>
            <ul class="actions vertical" v-if="!isUser">
                <LoginComponent :server="server" :successUser="successUser"/>

                <RegisterComponent :server="server" :successUser="successUser" />
            </ul>
            <ul v-else>
                <li><a href="" @click.prevent="changePage('PostAdd')">Создать пост</a></li>
                <li><a href="" @click.prevent="logout()">Выйти</a></li>
            </ul>
        </section>
    </section>
</template>

<script>
import LoginComponent from './LoginComponent.vue';
import RegisterComponent from './RegisterComponent.vue';

export default {
    name: 'MenuComponent',
    props: ['server', 'isUser', 'successUser', 'changePage', 'logout'],
    components: {
        RegisterComponent,
        LoginComponent,
    }
};
</script>
