<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <form class="container-fluid main-conta" autocomplete="off" @submit.prevent="submit"
              v-if="!loading">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>
                <generals-details></generals-details>
            </div>
            <form-buttons @cancel="cancel" :disabledSave="sending"></form-buttons>
        </form>
    </div>
</template>

<script lang="ts">
import {defineComponent, ref, onMounted, nextTick} from 'vue'
import {useRouter} from 'vue-router'
import {useStore} from 'vuex'
import Breadcrums from '@/components/Breadcrums.vue';
import GeneralsDetails from "@/modules/companies/components/GeneralsDetails.vue";
import FormButtons from "@/components/FormButtons.vue";
import {useCompany} from "@/modules/companies/use/useCompany";

export default defineComponent({
    components: {FormButtons, GeneralsDetails, Breadcrums},
    props: {
        id: {
            type: String,
            required: true
        }
    },
    setup(props) {
        const store = useStore();
        const router = useRouter();

        const breadcrumbUrl: string = store.state.ERP_URL + '/api/company/breadcrumbs'
        const sending = ref(false)
        const loading = ref(true)
        const {find, update} = useCompany()

        onMounted(async () => {
            await find(props.id ? props.id : '')
            nextTick(() => loading.value = false);
        });

        function cancel(): void {
            router.push({name: 'companies'});
        }

        async function submit() {
            try {
                sending.value = true
                await update();
                //todo: add toast
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
            loading,
            submit,
            cancel
        }
    }
});
</script>

<style scoped>

</style>
