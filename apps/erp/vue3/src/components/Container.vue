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
import {useStore} from 'vuex'
import Topbar from "@/components/Topbar";
import Leftbar from "@/components/Leftbar";

export default defineComponent({
    components: {Leftbar, Topbar},
    setup() {
        const store = useStore();
        const route = useRoute();

        function validation() {
            store.dispatch('validationToken');
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
