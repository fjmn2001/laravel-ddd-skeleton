<template>
    <div class="container">
        <form @submit.prevent="submit">
            <div>
                <label>Username</label>
                <input type="text" name="username" v-model="username">
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="username" v-model="password">
            </div>
            <div>
                <button type="submit">Sing In</button>
            </div>
        </form>
    </div>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
import axios from "axios";

@Component
export default class Login extends Vue {
    username = '';
    password = '';


    submit() {
        axios.post('http://localhost:8888/api/auth/login', {
            username: this.username,
            password: this.password
        }, {
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json'
            },
        }).then((response) => console.log(response.data));
    }
}
</script>

<style scoped>

</style>
