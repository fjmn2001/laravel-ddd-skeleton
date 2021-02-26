<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <form class="container-fluid mt-lg-5 mt-md-5 pt-lg-2 pt-md-2" autocomplete="off" @submit.prevent="submit">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>
                <div class="div-title-table mt-3 pl-1 pr-1 pt-2 row" id="tags"
                     style="position: sticky; top: 3px; z-index: 2; border-right-style: none; border-right-color: #ffffff; border-left-style: none; border-left-color: #ffffff; margin-right: -16px; margin-left: -16px;">
                </div>
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
import CompanyCreator from "@/modules/companies/Application/CompanyCreator";
import CompanyCreatorRequest from "@/modules/companies/Application/CompanyCreatorRequest";
import {v4 as uuidv4} from 'uuid';

export default defineComponent({
    components: {FormButtons, GeneralsDetails, Breadcrums},
    setup() {
        const store = useStore();
        const router = useRouter();

        const breadcrumbUrl: string = store.state.ERP_URL + '/api/company/breadcrumbs'
        const sending = ref(false)
        const company = store.state.companies.company

        function cancel(): void {
            router.push({name: 'companies'});
        }

        async function submit() {
            try {
                sending.value = true
                const creator = new CompanyCreator();
                await creator.__invoke(new CompanyCreatorRequest(
                    uuidv4(),
                    company.name,
                    company.state,
                    company.address,
                    company.phone
                ))
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
