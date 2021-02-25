<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <form class="container-fluid main-conta" autocomplete="off" @submit.prevent="submit"
              v-if="!loading">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumb_url="breadcrumb_url"></breadcrums>
                <generals-details></generals-details>
            </div>
            <form-buttons @cancel="cancel" :disabledSave="sending"></form-buttons>
        </form>
    </div>
</template>

<script lang="ts">
import {Component, Prop, Vue} from 'vue-property-decorator';
import Breadcrums from '@/components/Breadcrums.vue';
import GeneralsDetails from "@/modules/companies/form/GeneralsDetails.vue";
import FormButtons from "@/modules/shared/Infrastructure/FormButtons.vue";
import CompanyFinder from "@/modules/companies/Application/Find/CompanyFinder";
import CompanyFinderRequest from "@/modules/companies/Application/Find/CompanyFinderRequest";
import CompanyUpdaterRequest from "@/modules/companies/Application/Update/CompanyUpdaterRequest";
import CompanyUpdater from "@/modules/companies/Application/Update/CompanyUpdater";

@Component({
    components: {FormButtons, GeneralsDetails, Breadcrums}
})

export default class Edit extends Vue {
    @Prop(String) readonly id: string | undefined

    breadcrumb_url: string = this.$store.state.ERP_URL + '/api/company/breadcrumbs'

    sending = false
    loading = true
    company = this.$store.state.companies.company

    async mounted() {
        const finder = new CompanyFinder();
        const response = await finder.__invoke(new CompanyFinderRequest(this.id ? this.id : ''))

        this.$store.state.companies.company.id = response.data.id;
        this.$store.state.companies.company.name = response.data.name;
        this.$store.state.companies.company.state = response.data.state;
        this.$store.state.companies.company.address = response.data.address;
        this.$store.state.companies.company.phone = response.data.phone;

        //..
        Vue.nextTick(() => this.loading = false);
    }

    cancel(): void {
        this.$router.push({name: 'companies'});
    }

    async submit() {
        try {
            this.sending = true
            const updater = new CompanyUpdater();
            await updater.__invoke(new CompanyUpdaterRequest(
                this.company.id,
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
