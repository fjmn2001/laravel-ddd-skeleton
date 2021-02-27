<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <form class="container-fluid main-conta" autocomplete="off" @submit.prevent="submit">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>
                <generals-details></generals-details>
            </div>
            <form-buttons @cancel="cancel" :disabledSave="sending"></form-buttons>
        </form>
    </div>
</template>

<script lang="ts">
import {defineComponent, ref} from 'vue'
import {useRouter} from 'vue-router'
import {useStore} from 'vuex'
import Breadcrums from '@/components/Breadcrums.vue';
import GeneralsDetails from "@/modules/companies/components/GeneralsDetails.vue";
import FormButtons from "@/components/FormButtons.vue";
import {useCompany} from "@/modules/companies/use/useCompany";

export default defineComponent({
    components: {FormButtons, GeneralsDetails, Breadcrums},
    setup() {
        const store = useStore();
        const router = useRouter();

        const breadcrumbUrl: string = store.state.ERP_URL + '/api/company/breadcrumbs'
        const sending = ref(false)
        const {create} = useCompany()

        function cancel(): void {
            router.push({name: 'companies'});
        }

        async function submit() {
            try {
                sending.value = true
                await create()
                //todo: add toast
                //toastr.success('hola', 'exito');
                router.push({name: 'companies'});
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
            submit,
            cancel
        }
    }
});
</script>

<style scoped>

</style>
