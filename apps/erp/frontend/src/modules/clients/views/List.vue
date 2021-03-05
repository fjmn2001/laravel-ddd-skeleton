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
import {useStore} from 'vuex'

import Breadcrums from '@/components/Breadcrums.vue';
import SearchForm from "@/modules/clients/components/SearchForm.vue";

export default defineComponent({
    components: {SearchForm, Breadcrums},

    setup() {
        const store = useStore()
        const breadcrumbUrl: string = store.state.ERP_URL + '/api/client/breadcrumbs'

        return {
            store,
            breadcrumbUrl,
        }
    }
})
</script>

<style scoped>

</style>
