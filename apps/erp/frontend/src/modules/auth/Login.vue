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
            <div v-if="this.$store.state.token">
                <button type="button" @click="logout">Logout</button>
            </div>
            <pre>
                token: {{ this.$store.state.token }}
                <br>
                isLogged: {{ this.$store.getters.isLogged }}
            </pre>
        </form>
    </div>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';

@Component
export default class Login extends Vue {
    username = '';
    password = '';

    submit() {
        this.$store.dispatch('retrieveToken', {
            username: this.username,
            password: this.password
        })
    }

    logout() {
        this.$store.dispatch('destroyToken')
    }
}
</script>

<style scoped>

</style>
