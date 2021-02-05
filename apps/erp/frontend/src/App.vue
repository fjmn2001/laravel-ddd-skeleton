<template>
    <div id="app" class="bg-body font-weight-bold">
        <div id="wrapper">
            <topbar v-if="$route.meta.requiresAuth"></topbar>
            <leftbar v-if="$route.meta.requiresAuth"></leftbar>
            <router-view/>
        </div>
    </div>
</template>

<script>
import Topbar from "@/components/Topbar";
import Leftbar from "@/components/Leftbar";

export default {
    components: {Leftbar, Topbar}
}
</script>

<style lang="scss">
@import "./assets/css/new-style.css";
@import "./assets/css/style.css";
</style>
