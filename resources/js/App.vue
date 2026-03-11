<template>
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Header -->
        <HeaderComponent :user="user" :isUser="isUser" :changePage="changePage" :PUBLIC="PUBLIC" />

        <!-- Menu -->
        <MenuComponent :server="server" :isUser="isUser" :successUser="successUser" :changePage="changePage" :logout="logout" />

        <HomePage v-if="page == 'HomePage'" :server="server" :changePage="changePage" :PUBLIC="PUBLIC" />
        <PostAdd v-if="page == 'PostAdd'" :server="server" :changePage="changePage" :pageId="pageId" :PUBLIC="PUBLIC" />
        <SinglePage v-if="page == 'SinglePage'" :pageId="pageId" :isUser="isUser" :server="server" :changePage="changePage" :PUBLIC="PUBLIC" />
        <UserPage v-if="page == 'UserPage'" :pageId="pageId" :server="server" :changePage="changePage" :PUBLIC="PUBLIC" />
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
import UserPage from './pages/UserPage.vue';

export default {
    name: 'App',
    data() {
        return {
            page: localStorage.getItem('page')||"HomePage",
            pageId: localStorage.getItem('pageId')||"pageId",
            API: 'http://127.0.0.1:8000/api/',
            PUBLIC: 'http://127.0.0.1:8000/storage/',
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
        UserPage,
    },
    mounted() {
        if (localStorage.getItem('token')) {
            this.getUser();
        }
    },
    methods: {
        changePage(page, pageId = null) {
            this.page = page;
            this.pageId = pageId;
            localStorage.setItem("page", this.page);
            localStorage.setItem("pageId", this.pageId);
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
                    this.changePage('HomePage');
                }
                return response.json();
            });
        },
    },
};
</script>
