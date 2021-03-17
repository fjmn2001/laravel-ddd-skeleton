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
import {defineComponent, ref, onMounted} from 'vue'
import {useRouter} from 'vue-router'
import Breadcrums from '@/components/Breadcrums.vue';
import GeneralsDetails from "@/modules/items/components/GeneralsDetails.vue";
import FormButtons from "@/components/FormButtons.vue";
import {useItem} from "@/modules/items/use/useItem";
import {useCatalog} from "@/modules/items/use/useCatalog";
import {useCore} from "@/modules/shared/use/useCore";
import Loading from "@/components/form/Loading.vue";

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

        onMounted(async () => {
            await getCatalog();
            await reset();
            await console.log('get default values');
            loading.value = false
        })

        function cancel(): void {
            router.push({name: 'items'});
        }

        async function submit() {
            try {
                sending.value = true
                await create()
                //todo: add toast
                //toastr.success('hola', 'exito');
                router.push({name: 'items'});
            } catch (e) {
                //todo: add toast
                console.log('2', e);
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
