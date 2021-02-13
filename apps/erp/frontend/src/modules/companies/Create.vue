<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <form class="container-fluid mt-lg-5 mt-md-5 pt-lg-2 pt-md-2" @submit.prevent="submit">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumb_url="breadcrumb_url"></breadcrums>
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
import {Component, Vue} from 'vue-property-decorator';
import Breadcrums from '@/components/Breadcrums.vue';
import GeneralsDetails from "@/modules/companies/form/GeneralsDetails.vue";
import FormButtons from "@/modules/shared/Infrastructure/FormButtons.vue";
import CompanyCreator from "@/modules/companies/Application/CompanyCreator";
import CompanyCreatorRequest from "@/modules/companies/Application/CompanyCreatorRequest";
import {v4 as uuidv4} from 'uuid';

@Component({
    components: {FormButtons, GeneralsDetails, Breadcrums}
})

export default class Create extends Vue {
    breadcrumb_url: string = this.$store.state.ERP_URL + '/api/company/breadcrumbs'
    sending = false
    company = this.$store.state.companies.company

    cancel(): void {
        this.$router.push({name: 'companies'});
    }

    async submit() {
        try {
            this.sending = true
            const creator = new CompanyCreator();
            await creator.__invoke(new CompanyCreatorRequest(
                uuidv4(),
                this.company.name,
                this.company.state,
                this.company.address,
                this.company.phone
            ))
            //todo: add toast
            this.$router.push({name: 'companies'});
        } catch (e) {
            //todo: add toast
            console.log('2', e);
        } finally {
            this.sending = false
        }
    }
}
</script>

<style scoped>

</style>
