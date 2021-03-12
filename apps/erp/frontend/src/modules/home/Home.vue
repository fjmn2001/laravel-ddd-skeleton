<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <div class="container-fluid main-conta pr-2r">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>
                <div class="xcontainer">
                    <p>Routes prototyped in vuejs</p>
                    <ul style="list-style: none">
                        <li >Empresas</li>
                    </ul>
                </div>
            </div>
        </div>
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
        const breadcrumbUrl = ERP_URL + '/api/company/breadcrumbs';

        return {
            breadcrumbUrl
        }
    }
});

</script>

<style scoped>

</style>
