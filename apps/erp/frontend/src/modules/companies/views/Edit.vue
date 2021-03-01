<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <form class="container-fluid main-conta" autocomplete="off" @submit.prevent="submit">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>
                <generals-details v-if="!loading"></generals-details>
                <div class="xcontainer" v-show="loading">
                    <div class="align-items-center d-flex div-title-card justify-content-between row">
                        <div class="align-items-baseline d-sm-flex flex-md-row flex-sm-column">
                            <h5 class="stitle-preloader xtitle-buscar"></h5>
                            <p class="ml-md-3 ml-sm-0 pt-md-0 pt-sm-1 st-des-preloader xsubtitle-buscar"></p>
                        </div>
                        <div href="#des011" data-toggle="collapse" class="icon-preloader"></div>
                    </div>
                    <div id="des011" class="des01 m-3 pb-3">
                        <div class="mt-3 pl-3 pr-3 row">
                            <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
                                <div class="ima-preloader"></div>
                            </div>
                            <div class="col-lg-9 col-md-6 col-sm-12 pt-4">
                                <label class="label-preloader"></label>
                                <div class="inp-preloader"></div>
                                <div class="mt-3 row">
                                    <div class="col-lg-6 col-md-12">
                                        <label class="label-preloader"></label>
                                        <div class="inp-preloader"></div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label class="label-preloader"></label>
                                        <div class="inp-preloader"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pl-3 pr-3 row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="label-preloader"></label>
                                <div class="inp-preloader"></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="label-preloader"></label>
                                <div class="inp-preloader"></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="label-preloader"></label>
                                <div class="inp-preloader"></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="label-preloader"></label>
                                <div class="inp-preloader"></div>
                            </div>
                        </div>
                        <div class="mt-3 pl-3 pr-3 row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="label-preloader"></label>
                                <div class="inp-preloader"></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="label-preloader"></label>
                                <div class="inp-preloader"></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="label-preloader"></label>
                                <div class="inp-preloader"></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label class="label-preloader"></label>
                                <div class="inp-preloader"></div>
                            </div>
                        </div>
                    </div>
                </div>
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
