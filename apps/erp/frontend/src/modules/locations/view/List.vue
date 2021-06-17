<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <div class="container-fluid main-conta">
            <div class="pl-1 pr-1">
                <breadcrumbs :breadcrumbUrl="breadcrumbUrl"></breadcrumbs>

                <SearchForm tableName="tableName"></SearchForm>

                <MainTable tableName="tableName"></MainTable>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, watch} from "vue";
import Breadcrumbs from '@/components/Breadcrums.vue';
import SearchForm from "@/modules/locations/component/SearchForm.vue";
import MainTable from "@/modules/locations/component/MainTable.vue";
import {useCore} from "@/modules/shared/use/useCore";
import {Company} from "@/modules/auth/types/Company";
import {useAuth} from "@/modules/auth/use/useAuth";

export default defineComponent({
    components: {Breadcrumbs, SearchForm, MainTable},
    setup() {
        const {ERP_URL} = useCore();
        const breadcrumbUrl: string = ERP_URL + '/api/locations/breadcrumbs'
        const tableName = 'locations'
        const {user} = useAuth();

        onMounted(async () => {
            //await getCatalog();
        })

        //when changeCompany
        watch(() => user.value?.company, async (company: Company | undefined) => {
            if (company) {
                //await getCatalog();
            }
        })

        return {
            breadcrumbUrl,
            tableName
        }
    }
})
</script>

<style scoped>

</style>
