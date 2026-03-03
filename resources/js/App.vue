<template>
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Header -->
        <HeaderComponent :user="user" :isUser="isUser" :PUBLIC="PUBLIC" />

        <!-- Menu -->
        <MenuComponent :server="server" :isUser="isUser" :successUser="successUser" />

        <HomePage v-if="page == 'HomePage'" />
        <SinglePage v-if="page == 'SinglePage'" />
        <PostAdd v-if="page == 'PostAdd'" />
    </div>
    <FooterComponent />
</template>

<script>
import FooterComponent from './components/FooterComponent.vue';
import HeaderComponent from './components/HeaderComponent.vue';
import MenuComponent from './components/MenuComponent.vue';
import HomePage from './pages/HomePage.vue';
import PostAdd from './pages/PostAdd.vue';
import SinglePage from './pages/SinglePage.vue';

export default {
    name: 'App',
    data() {
        return {
            page: 'HomePage',
            pageId: null,
            API: 'http://127.0.0.1:8000/api/',
            PUBLIC: 'http://127.0.0.1:8000/storage/app/public/',
            isUser: false,
            user: {},
        };
    },
    components: {
        HeaderComponent,
        MenuComponent,
        FooterComponent,
        HomePage,
        PostAdd,
        SinglePage,
    },
    mounted() {
        if (localStorage.getItem('token')) {
            this.getUser();
        }
    },
    methods: {
        changePage(page) {
            this.page = page;
        },
        getUser() {
            this.server('user')
                .then((result) => {
                    this.user = result;
                    this.isUser = true;
                })
                .catch((error) => console.log('error', error));
        },
        successUser(token) {
            localStorage.setItem('token', token);
            this.isUser = true;
            this.getUser();
        },
        logout() {
            localStorage.removeItem('token');
            this.user = {};
            this.getUser();
        },
        async server(route, method = 'GET', formdata = null) {
            let myHeaders = new Headers();
            myHeaders.append('Accept', 'application/json');

            if (localStorage.getItem('token')) {
                myHeaders.append('Authorization', 'Bearer ' + localStorage.getItem('token'));
            }

            let requestOptions = {
                method: method,
                headers: myHeaders,
                redirect: 'follow',
            };
            if (method != 'GET') {
                requestOptions.body = formdata;
            }

            return await fetch(this.API + route, requestOptions).then((response) => {
                if (response.status == 401) {
                    localStorage.removeItem('token');
                    this.changePage('AuthPage');
                }
                return response.json();
            });
        },
    },
};
</script>
