<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <form class="container-fluid main-conta" autocomplete="off" @submit.prevent="submit">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>
                <generals-details v-if="!loading"></generals-details>
                <contact-information v-if="!loading"></contact-information>
                <payment-information v-if="!loading"></payment-information>
                <users-assigned-client v-if="!loading"></users-assigned-client>
            </div>
            <form-buttons @cancel="cancel" :disabledSave="sending"></form-buttons>
        </form>
    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref} from 'vue'
import {useRouter} from 'vue-router'
import {useCore} from "@/modules/shared/use/useCore";
import {useClient} from "@/modules/clients/use/useClient";

import Breadcrums from '@/components/Breadcrums.vue';
import FormButtons from "@/components/FormButtons.vue";
import GeneralsDetails from "@/modules/clients/components/GeneralsDetails.vue";
import ContactInformation from "@/modules/clients/components/ContactInformation.vue";
import PaymentInformation from "@/modules/clients/components/PaymentInformation.vue";
import UsersAssignedClient from "@/modules/clients/components/UsersAssignedClient.vue";

export default defineComponent({
    components: {
        Breadcrums,
        GeneralsDetails,
        ContactInformation,
        PaymentInformation,
        UsersAssignedClient,
        FormButtons,
    },
    setup() {
        const router = useRouter();
        const {ERP_URL} = useCore();
        const breadcrumbUrl: string = ERP_URL + '/api/client/breadcrumbs'
        const loading = ref(true);
        const sending = ref(false)
        const {create, reset} = useClient()

        onMounted(async () => {
            await reset();
            loading.value = false
        })

        function cancel(): void {
            router.push({name: 'clients'});
        }

        async function submit() {
            try {
                sending.value = true
                await create()
                //todo: add toast
                //toastr.success('hola', 'exito');
                // router.push({name: 'clients'});
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
})
</script>

<style scoped>

</style>
