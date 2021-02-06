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

@Component({
    components: {FormButtons, GeneralsDetails, Breadcrums}
})

export default class Create extends Vue {
    breadcrumb_url: string = this.$store.state.ERP_URL + '/api/company/breadcrumbs'
    sending = false

    cancel(): void {
        console.log('cancel')
    }

    submit(): void {
        this.sending = true
        console.log('submit')

        setTimeout(() => this.sending = false, 2000)
    }
}
</script>

<style scoped>

</style>
