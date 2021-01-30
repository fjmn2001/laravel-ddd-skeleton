<template>
    <div>
        <h1>Hi there!!!</h1>
        <button type="button" @click.prevent="logout">Logout</button>
    </div>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';

@Component
export default class Login extends Vue {
    logout() {
        this.$store.dispatch('destroyToken').then(() => {
            console.log('goto landing page...');
        })
    }
}
</script>

<style scoped>

</style>
