<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <form class="container-fluid main-conta" autocomplete="off" @submit.prevent="submit">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>
                <generals-details v-if="!loading"></generals-details>
                <loading v-show="loading"></loading>
            </div>
            <form-buttons @cancel="cancel" :disabledSave="sending"></form-buttons>
        </form>
    </div>
</template>

<script lang="ts">
import toastr from "toastr";
import {defineComponent, ref, onMounted, watch} from 'vue'
import {useRouter} from 'vue-router'
import Breadcrums from '@/components/Breadcrums.vue';
import GeneralsDetails from "@/modules/items/components/GeneralsDetails.vue";
import FormButtons from "@/components/FormButtons.vue";
import {useItem} from "@/modules/items/use/useItem";
import {useCatalog} from "@/modules/items/use/useCatalog";
import {useCore} from "@/modules/shared/use/useCore";
import Loading from "@/components/form/Loading.vue";
import {Company} from "@/modules/auth/types/Company";
import {useAuth} from "@/modules/auth/use/useAuth";

export default defineComponent({
    components: {Loading, FormButtons, GeneralsDetails, Breadcrums},
    setup() {
        const {ERP_URL} = useCore();
        const router = useRouter();

        const breadcrumbUrl: string = ERP_URL + '/api/items/breadcrumbs'
        const sending = ref(false)
        const {create, reset} = useItem()
        const {getCatalog} = useCatalog();
        const loading = ref(true);
        const {user} = useAuth();

        async function initComponent() {
            await getCatalog();
            await reset();
            loading.value = false
        }

        onMounted(async () => {
            initComponent();
        })

        //when changeCompany
        watch(() => user.value?.company, async (company: Company | undefined) => {
            if (company) {
                loading.value = true
                initComponent()
            }
        })

        function cancel(): void {
            router.push({name: 'items'});
        }

        async function submit() {
            try {
                sending.value = true
                await create()
                toastr.success("Su solicitud se ha procesado correctamente.");
                router.push({name: 'items'});
            } catch (e) {
                toastr.error(e?.response?.data?.message);
                console.log(e);
            } finally {
                sending.value = false
            }
        }

        return {
            breadcrumbUrl,
            sending,
            loading,
            submit,
            cancel
        }
    }
});
</script>

<style scoped>

</style>
