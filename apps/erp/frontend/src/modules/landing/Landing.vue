<template>
    <div>
        <h1>Landing Page</h1>
        <router-link :to="{name: 'auth.login'}">Login</router-link>
    </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({});
</script>

<style scoped>

</style>
