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
import {defineComponent, nextTick, onMounted, ref} from 'vue'
import {useCore} from "@/modules/shared/use/useCore";
import {useRouter} from "vue-router";
import {useClient} from "@/modules/clients/use/useClient";

import Breadcrums from '@/components/Breadcrums.vue';
import FormButtons from "@/components/FormButtons.vue";
import GeneralsDetails from "@/modules/clients/components/GeneralsDetails.vue";
import ContactInformation from "@/modules/clients/components/ContactInformation.vue";
import PaymentInformation from "@/modules/clients/components/PaymentInformation.vue";
import UsersAssignedClient from "@/modules/clients/components/UsersAssignedClient.vue";

export default defineComponent({
    components: {Breadcrums, FormButtons, GeneralsDetails, ContactInformation, PaymentInformation, UsersAssignedClient},
    props: {
        id: {
            type: String,
            required: true
        }
    },
    setup(props) {
        const router = useRouter();
        const {ERP_URL} = useCore();
        const {find} = useClient()
        const loading = ref(true);
        const sending = ref(false)
        const breadcrumbUrl: string = ERP_URL + '/api/client/breadcrumbs'


        onMounted(async () => {
            await find(props.id ? props.id : '')
            nextTick(() => loading.value = false);
        });



        function cancel(): void {
            router.push({name: 'clients'});
        }

        return {
            breadcrumbUrl,
            sending,
            loading,

            cancel,
        }
    }
})
</script>

<style scoped>

</style>
