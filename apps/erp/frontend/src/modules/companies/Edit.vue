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
        <pre>
            {{ $store.state.companies }}
        </pre>
    </div>
</template>

<script lang="ts">
import {Component, Prop, Vue} from 'vue-property-decorator';
import Breadcrums from '@/components/Breadcrums.vue';
import GeneralsDetails from "@/modules/companies/form/GeneralsDetails.vue";
import FormButtons from "@/modules/shared/Infrastructure/FormButtons.vue";
import CompanyFinder from "@/modules/companies/Application/Find/CompanyFinder";
import CompanyFinderRequest from "@/modules/companies/Application/Find/CompanyFinderRequest";

@Component({
    components: {FormButtons, GeneralsDetails, Breadcrums}
})

export default class Edit extends Vue {
    @Prop(String) readonly id: string | undefined

    breadcrumb_url: string = this.$store.state.ERP_URL + '/api/company/breadcrumbs'

    sending = false
    company = this.$store.state.companies.company

    async mounted() {
        const finder = new CompanyFinder();
        const response = await finder.__invoke(new CompanyFinderRequest(this.id ? this.id : ''))

        this.$store.state.companies.company.id = response.data.id;
        this.$store.state.companies.company.name = response.data.name;
        this.$store.state.companies.company.state = response.data.state;
        this.$store.state.companies.company.address = response.data.address;
        this.$store.state.companies.company.phone = response.data.phone;
    }

    cancel(): void {
        this.$router.push({name: 'companies'});
    }

    async submit() {
        console.log('todo:');
        // try {
        //     this.sending = true
        //     const creator = new CompanyCreator();
        //     await creator.__invoke(new CompanyCreatorRequest(
        //         uuidv4(),
        //         this.company.name,
        //         this.company.state,
        //         this.company.address,
        //         this.company.phone
        //     ))
        //     //todo: add toast
        //     this.$router.push({name: 'companies'});
        // } catch (e) {
        //     //todo: add toast
        //     console.log('2', e);
        // } finally {
        //     this.sending = false
        // }
    }
}
</script>

<style scoped>

</style>
