<template>
    <div>
        <h1>Landing Page</h1>
        <router-link :to="{name: 'auth.login'}">Login</router-link>
    </div>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';

@Component
export default class Landing extends Vue {

}
</script>

<style scoped>

</style>
