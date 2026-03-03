<template>
    <li><h3>Registration</h3></li>
    <li>
        <input type="text" placeholder="Name" v-model="name" /><br />

        <p class="red" v-if="errors.name">
            {{ errors.name.join('. ') }}
        </p>
        <input type="text" placeholder="Username" v-model="username" /><br />
        <p class="red" v-if="errors.username">
            {{ errors.username.join('. ') }}
        </p>
        <input type="password" placeholder="Password" v-model="password" /><br />
        <p class="red" v-if="errors.password">
            {{ errors.password.join('. ') }}
        </p>
        <input type="file" id="avatar"/><br /><br />
        <p class="red" v-if="errors.avatar">
            {{ errors.avatar.join('. ') }}
        </p>
        <button type="button" @click="register" class="button big fit">Регистрация</button>
    </li>
</template>
<script>
export default {
    name: 'RegisterComponent',
    props: ['server', 'successUser'],
    data() {
        return {
            name: null,
            username: null,
            password: null,
            errors: {},
        };
    },
    methods: {
        register() {
            let formdata = new FormData();
            if (this.name) formdata.append('name', this.name);
            if (this.username) formdata.append('username', this.username);
            if (this.password) formdata.append('password', this.password);
            let avatar = document.querySelector("#avatar");
            if(avatar.files[0]) {
                formdata.append('avatar', avatar.files[0]);
            }
            this.server('register', 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    }
                    if (result.token) {
                        this.successUser(result.token);
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
