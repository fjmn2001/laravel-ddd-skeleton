<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <div class="container-fluid main-conta">
            <div class="pl-1 pr-1">
                <breadcrumbs :breadcrumbUrl="breadcrumbUrl"></breadcrumbs>

                <SearchForm></SearchForm>

                <MainTable></MainTable>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import Breadcrumbs from '@/components/Breadcrums.vue';
import SearchForm from "@/modules/locations/component/SearchForm.vue";
import MainTable from "@/modules/locations/component/MainTable.vue";
import {useCore} from "@/modules/shared/use/useCore";

export default defineComponent({
    components: {Breadcrumbs, SearchForm, MainTable},
    setup() {
        const {ERP_URL} = useCore();
        const breadcrumbUrl: string = ERP_URL + '/api/locations/breadcrumbs'

        return {
            breadcrumbUrl
        }
    }
})
</script>

<style scoped>

</style>
