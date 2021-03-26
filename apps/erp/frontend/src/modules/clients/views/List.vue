<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <div class="container-fluid main-conta">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>

                <div class=" xcontainer">
                    <search-form></search-form>
                </div>

                <div class=" xcontainer">
                    <div>
                        <div class="align-items-center d-flex div-title-card justify-content-between row">
                            <div class="align-items-baseline d-sm-flex flex-md-row flex-sm-column">
                                <h5 class="xtitle-buscar">Lista de clientes</h5>
                                <p class="ml-md-3 ml-sm-0 pt-md-0 pt-sm-1 xsubtitle-buscar">(Tabla principai)</p>
                            </div>
                            <a href="#des02" id="desplegar-busqueda1" data-toggle="collapse"><i
                                class="fa fa-chevron-up"></i></a>
                        </div>

                        <div id="des02" class="pb-3 pl-4 pr-4 pt-3" v-if="hasData() && !loading">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th id="th-ini-sd">
                                            <input type="checkbox" class="chk">
                                        </th>
                                        <th>Nombre<i class="fa fa-sort thead-i"></i></th>
                                        <th>Identificación<i class="fa fa-sort thead-i"></i></th>
                                        <th>Teléfono<i class="fa fa-sort thead-i"></i></th>
                                        <th>Correo electrónico<i class="fa fa-sort thead-i"></i></th>
                                        <th>Crédito a favor</th>
                                        <th>Saldo por cobrar</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="client in clients" :key="client.id">
                                        <th>
                                            <input type="checkbox" class="chk">
                                        </th>
                                        <td>
                                            <router-link
                                                :to="{name: 'clients.edit', params:{id: client.id}}">
                                                {{ client.name }}
                                            </router-link>
                                        </td>

                                        <td></td>
                                        <td>{{client.phone.number}}</td>
                                        <td>{{client.email.email}}</td>
                                        <td></td>
                                        <td></td>
                                        <td class=" td-btn-med">
                                            <span v-html="client.state" @click.prevent="changeState(client.id)"></span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-opt" href="#" @click.prevent="showOptionsModal(client.id)">
                                                    <img src="@/assets/images/icons/3puntos_H.svg"> </a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <table-pager></table-pager>

                        <no-results v-if="!hasData() && !loading"></no-results>
                        <loading v-if="loading"></loading>
                        <options-modal :name="'optionsModal'"></options-modal>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, watch} from 'vue'
import {useCore} from "@/modules/shared/use/useCore";
import {useClients} from "@/modules/clients/use/useClients";
import {useFilters} from "@/modules/clients/use/useFilters";
import {useModal} from "@/use/useModal";
import {useAuth} from "@/modules/auth/use/useAuth";
import {api} from "@/modules/clients/services/api";

import Breadcrums from '@/components/Breadcrums.vue';
import SearchForm from "@/modules/clients/components/SearchForm.vue";
import NoResults from "@/components/table/NoResults.vue";
import Loading from "@/components/table/Loading.vue";
import TablePager from "@/components/TablePager.vue";
import OptionsModal from "@/components/modal/optionsModal.vue";

import $ from "jquery";
import {Company} from "@/modules/auth/types/Company";
import router from "@/router";

export default defineComponent({
    components: {
        NoResults,
        Loading,
        TablePager,
        SearchForm,
        OptionsModal,
        Breadcrums
    },

    setup() {
        const {ERP_URL} = useCore();
        const {clients, hasData, loading, getClients} = useClients();
        const {show, populateLoading, populateBody, hide} = useModal();
        const {setFilters} = useFilters()
        const {user} = useAuth();

        const breadcrumbUrl: string = ERP_URL + '/api/client/breadcrumbs'

        async function initComponent() {
            await setFilters([
                {field: 'companyId', value: user?.value?.company.id}
            ]);
            await getClients();
        }
        onMounted( async () => {
            initComponent()
        });

        //when changeCompany
        watch(() => user.value?.company, async (company: Company | undefined) => {
            if (company) {
                initComponent()
            }
        })

        async function changeState(id: string) {
            show('optionsModal')
            populateLoading('optionsModal')
            const modal = $('#optionsModal');
            const response = await api.getClientStates(id);
            populateBody('optionsModal', response)
            modal.off('click', '.updateState').on('click', '.updateState', async (e) => {
                populateLoading('optionsModal')
                await api.updateClientState(
                    $(e.target).data('id'),
                    $(e.target).data('state')
                )
                hide('optionsModal')
                await setFilters([
                    {field: 'companyId', value: user?.value?.company.id}
                ]);
                await getClients();
            });
        }

        async function showOptionsModal(id: string) {
            show('optionsModal')
            populateLoading('optionsModal')

            const html = await api.getClientOptions(id)
            const modal = $('#optionsModal');

            populateBody('optionsModal', html)

            modal.off('click', '.edit').on('click', '.edit', async () => {
                hide('optionsModal')
                router.push({name: 'clients.edit', params: {id}});
            });

            modal.off('click', '.changeState').on('click', '.changeState', async () => {
                hide('optionsModal')
                changeState(id)
            });
        }

        return {
            breadcrumbUrl,
            clients,
            hasData,
            loading,

            changeState,
            showOptionsModal,
        }
    }
})
</script>

<style scoped>

</style>
