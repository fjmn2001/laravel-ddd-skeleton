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
import CompanyFinder from "@/modules/companies/Application/Find/CompanyFinder";
import CompanyFinderRequest from "@/modules/companies/Application/Find/CompanyFinderRequest";
import CompanyUpdaterRequest from "@/modules/companies/Application/Update/CompanyUpdaterRequest";
import CompanyUpdater from "@/modules/companies/Application/Update/CompanyUpdater";

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
        const company = store.state.companies.company

        async function setValues() {
            const finder = new CompanyFinder();
            const response = await finder.__invoke(new CompanyFinderRequest(props.id ? props.id : ''))

            store.state.companies.company.id = response.data.id;
            store.state.companies.company.name = response.data.name;
            store.state.companies.company.state = response.data.state;
            store.state.companies.company.address = response.data.address;
            store.state.companies.company.phone = response.data.phone;

            //..
            nextTick(() => loading.value = false);
        }

        onMounted(setValues);

        function cancel(): void {
            router.push({name: 'companies'});
        }

        async function submit() {
            try {
                sending.value = true
                const updater = new CompanyUpdater();
                await updater.__invoke(new CompanyUpdaterRequest(
                    company.id,
                    company.name,
                    company.state,
                    company.address,
                    company.phone
                ))
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
