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
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class=" td-btn-med">
                                            <button type="button" class="btn btn-green btn-sm btn-table"
                                                    v-html="client.state"></button>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-opt" href="#">
                                                    <img src="@/assets/images/icons/3puntos_H.svg"> </a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <table-pager></table-pager>
                        </div>

                        <no-results v-if="!hasData() && !loading"></no-results>
                        <loading v-if="loading"></loading>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted} from 'vue'
import {useCore} from "@/modules/shared/use/useCore";
import {useClients} from "@/modules/clients/use/useClients";

import Breadcrums from '@/components/Breadcrums.vue';
import SearchForm from "@/modules/clients/components/SearchForm.vue";
import NoResults from "@/components/table/NoResults.vue";
import Loading from "@/components/table/Loading.vue";
import TablePager from "@/components/TablePager.vue";

export default defineComponent({
    components: {
        NoResults,
        Loading,
        TablePager,
        SearchForm,
        Breadcrums
    },

    setup() {
        const {ERP_URL} = useCore();
        const {clients, hasData, loading, getClients} = useClients();
        const breadcrumbUrl: string = ERP_URL + '/api/client/breadcrumbs'

        onMounted( async () => {
           await getClients();
        });

        return {
            breadcrumbUrl,
            clients,
            hasData,
            loading,
        }
    }
})
</script>

<style scoped>

</style>
