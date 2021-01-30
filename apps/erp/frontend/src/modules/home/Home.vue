<template>
    <div>
        <h1>Hi there!!!</h1>
        <button type="button" @click.prevent="logout">Logout</button>
    </div>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';

@Component
export default class Home extends Vue {
    logout() {
        this.$store.dispatch('destroyToken').then(() => {
            this.$router.push({name: 'landing'});
        })
    }
}
</script>

<style scoped>

</style>
