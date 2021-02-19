<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <div class="container-fluid mt-lg-5 mt-md-5 pt-lg-2 pt-md-2">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumb_url="breadcrumb_url"></breadcrums>
                <div class="ml-n3 mr-n3 xcontainer">
                    <search-form></search-form>
                    <div>
                        <div class="align-items-center d-flex justify-content-between mb-2 row">
                            <div class="align-items-baseline d-sm-flex flex-md-row flex-sm-column"
                                 style="padding-left: 27px;">
                                <h5 class="xtitle-buscar" style="margin-left: 20px;">Lista de empresas</h5>
                                <p class="ml-3 ml-lg-0  xsubtitle-buscar">(Tabla principal)</p>
                            </div>
                        </div>
                        <div id="des02" class="pl-4 pr-4" v-if="hasData() && !loading()">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th id="th-ini" style="padding-left: 39px;text-align: center;">&nbsp;
                                            <input type="checkbox" class="chk" style="margin-left: -58px;">
                                        </th>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Fecha de creación</th>
                                        <th>Cantidad de usuario</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="company in $store.state.companies.list" :key="company.id">
                                        <th class="align-items-center d-flex">
                                            <input type="checkbox" class="chk ml-4">
                                        </th>
                                        <td v-html="company.name" @click="goToDetails(company.id)"></td>
                                        <td v-html="company.name">Lider.C.A</td>
                                        <td>01/01/2021</td>
                                        <td>3</td>
                                        <td class=" td-btn-med">
                                            <button type="button" class="btn btn-green btn-sm btn-table">Activo</button>
                                            &nbsp;
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-opt" href="#" role="button" id="dropdownMenu1"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="images/icons/3puntos_H.svg"> </a>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="dropdownMenu1">
                                                    <a class="dropdown-item" href="#">Duplicar</a>
                                                    <a class="dropdown-item" href="#">Realizar pago</a>
                                                    <a class="dropdown-item" href="#">Copiar</a>
                                                    <a class="dropdown-item" href="#">Eliminar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="justify-content-center mt-0 pt-0 row">
                                <div
                                    class="align-items-center col-md-6 d-flex justify-content-center offset-md-3 pb-3 pt-3">
                                    <div class="d-flex">
                                        <a class="btn btn-cicle"><img src="images/icons/two-arrow-left.svg"></a>
                                        <a class="btn btn-cicle"><img src="images/icons/one-arrow-left.svg"></a>
                                        <p class="p-pag">página <input type="text" value="1" class="inp-pag">&nbsp;de 6
                                        </p>
                                        <a class="btn btn-cicle"><img src="images/icons/one-arrow-right.svg"></a>
                                        <a class="btn btn-cicle"><img src="images/icons/two-arrow-right.svg"></a>
                                    </div>
                                </div>
                                <div class="align-items-center col-md-3 d-flex justify-content-end pb-3 pt-3">
                                    <p class="mr-4 p-pag">Mostrando 1 - 10 de 20</p>
                                </div>
                            </div>
                        </div>
                        <div class="pl-4 pr-4" v-if="!hasData() && !loading()">
                            <div class="alert alert-danger">
                                <p>TODO: design when do not has data</p>
                            </div>
                        </div>
                        <div class="pl-4 pr-4" v-if="loading()">
                            <div class="alert alert-info">
                                <p>TODO: design when is loading</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
import Breadcrums from '@/components/Breadcrums.vue';
import SearchForm from "@/modules/companies/Infrastructure/SearchForm.vue";
import CompanySearcherRequest from "@/modules/companies/Application/Searcher/CompanySearcherRequest";
import CompanySearcher from "@/modules/companies/Application/Searcher/CompanySearcher";

@Component({
    components: {SearchForm, Breadcrums}
})

export default class List extends Vue {
    breadcrumb_url: string = this.$store.state.ERP_URL + '/api/company/breadcrumbs'
    loaded = false

    async mounted() {
        this.$store.dispatch('companies/changeLoading', true);
        const searcher = new CompanySearcher();
        const response = await searcher.__invoke(
            new CompanySearcherRequest([], 'created_at', 'desc', 10, 0)
        )
        this.$store.state.companies.list = response.data;
        this.$store.dispatch('companies/changeLoading', false);
        this.loaded = true;
    }

    loading(): boolean {
        return this.$store.state.companies.loading;
    }

    hasData() {
        return this.$store.state.companies.list.length > 0 && this.loaded;
    }

    goToDetails(id: string) {
        this.$router.push({name: 'companies.edit', params: {id}});
    }
}
</script>

<style scoped>

</style>
