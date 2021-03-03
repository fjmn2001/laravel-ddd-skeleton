<template>
    <div id="app" class="bg-body font-weight-bold">
        <div id="wrapper">
            <topbar v-if="route.meta.requiresAuth"></topbar>
            <leftbar v-if="route.meta.requiresAuth"></leftbar>
            <router-view/>
        </div>
    </div>
</template>

<script>
import {defineComponent, onMounted} from 'vue'
import {useRoute} from 'vue-router'
import Topbar from "@/components/Topbar";
import Leftbar from "@/components/Leftbar";
import {useAuth} from "@/modules/auth/use/useAuth";

export default defineComponent({
    components: {Leftbar, Topbar},
    setup() {
        const {validationToken} = useAuth();
        const route = useRoute();

        function validation() {
            validationToken();
        }

        onMounted(() => {
            validation();
        });

        return {
            route
        }
    }
});
</script>

<style scoped>

</style>
