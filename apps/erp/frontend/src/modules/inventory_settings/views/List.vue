<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <div class="container-fluid main-conta">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>
            </div>
        </div>
        <h1>Wohoooo!!!</h1>
    </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import Breadcrums from '@/components/Breadcrums.vue';
import {useCore} from "@/modules/shared/use/useCore";

export default defineComponent({
    components: {Breadcrums},
    setup() {
        const {ERP_URL} = useCore();
        const breadcrumbUrl: string = ERP_URL + '/api/company/breadcrumbs'

        return {
            breadcrumbUrl
        }
    }
})
</script>

<style scoped>

</style>
