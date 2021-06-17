<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <div class="container-fluid main-conta">
            <div class="pl-1 pr-1">
                <breadcrumbs :breadcrumbUrl="breadcrumbUrl"></breadcrumbs>

                <generals-details :catalogs="catalogs" v-if="!loading"></generals-details>

                <loading v-if="loading"></loading>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref} from "vue";
import Breadcrumbs from '@/components/Breadcrums.vue';
import GeneralsDetails from "@/modules/locations/component/GeneralsDetails.vue";
import {useCore} from "@/modules/shared/use/useCore";
import axios from "axios";
import {Catalog} from "@/modules/locations/type/Catalog";
import Loading from "@/components/table/Loading.vue";

export default defineComponent({
    components: {Loading, Breadcrumbs, GeneralsDetails},
    setup() {
        const {ERP_URL} = useCore();
        const breadcrumbUrl: string = ERP_URL + '/api/locations/breadcrumbs'
        const loading = ref(true)
        const catalogs = ref({})
        const details = ref({})

        function defaultValues() {
            return {}
        }

        async function retrieveCatalogs(): Promise<Catalog> {
            const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/locations/catalogs');
            return new Promise(resolve => {
                resolve(response.data);
            });
        }

        onMounted(async () => {
            details.value = await defaultValues()
            catalogs.value = await retrieveCatalogs()
            loading.value = false
        })

        return {
            breadcrumbUrl,
            loading,
            catalogs,
            details
        }
    }
})
</script>

<style scoped>

</style>
