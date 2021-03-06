<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <div class="container-fluid main-conta">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>

                <div class=" xcontainer">
                    <search-form></search-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import {useCore} from "@/modules/shared/use/useCore";

import Breadcrums from '@/components/Breadcrums.vue';
import SearchForm from "@/modules/clients/components/SearchForm.vue";

export default defineComponent({
    components: {SearchForm, Breadcrums},

    setup() {
        const {ERP_URL} = useCore();
        const breadcrumbUrl: string = ERP_URL + '/api/client/breadcrumbs'

        return {
            breadcrumbUrl,
        }
    }
})
</script>

<style scoped>

</style>
