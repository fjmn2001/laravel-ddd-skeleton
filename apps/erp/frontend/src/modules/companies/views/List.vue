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
                                <h5 class="xtitle-buscar">Lista de empresas</h5>
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
                                        <th>Fecha de creación<i class="fa fa-sort thead-i"></i></th>
                                        <th>Cantidad de usuario<i class="fa fa-caret-down thead-i"></i></th>
                                        <th>Estado<i class="fa fa-caret-up thead-i"></i></th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="company in companies" :key="company.id">
                                        <th>
                                            <input type="checkbox" class="chk">
                                        </th>
                                        <td>
                                            <router-link
                                                :to="{name: 'companies.edit', params:{id: company.id}}">
                                                {{ company.name }}
                                            </router-link>
                                        </td>
                                        <td v-text="company.createdAt"></td>
                                        <td v-text="company.usersQuantity"></td>
                                        <td class=" td-btn-med">
                                            <button type="button" class="btn btn-green btn-sm btn-table"
                                                    v-html="company.stateValue" data-toggle="modal" data-target="#exampleModalEstado"></button>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-opt" href="#" data-toggle="modal" data-target="#exampleModal">
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

        <teleport to="body">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Opciones</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-4">

                            <button class="btn btn-block  my-3 btn-modal">Copiar</button>
                            <button class="btn btn-block  my-3 btn-modal">Suspender</button>
                            <button class="btn btn-block  my-3 btn-modal">Editar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModalEstado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Opciones</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-4">

                            <button class="btn btn-block  my-3 btn-outline-success">Activo</button>
                            <button class="btn btn-block  my-3 btn-outline-danger">Desactivado</button>
                        </div>
                    </div>
                </div>
            </div>
        </teleport>
    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref} from 'vue'
import Breadcrums from '@/components/Breadcrums.vue';
import SearchForm from "@/modules/companies/components/SearchForm.vue";
import {useCompanies} from "@/modules/companies/use/useCompanies";
import {useCatalog} from "@/modules/companies/use/useCatalog";
import {useCore} from "@/modules/shared/use/useCore";
import TablePager from "@/components/TablePager.vue";
import NoResults from "@/components/table/NoResults.vue";
import Loading from "@/components/table/Loading.vue";

export default defineComponent({
    components: {Loading, NoResults, TablePager, SearchForm, Breadcrums},
    setup() {
        const {ERP_URL} = useCore();
        const {companies, hasData, loading, getCompanies} = useCompanies();
        const {getCatalog} = useCatalog();
        const breadcrumbUrl: string = ERP_URL + '/api/company/breadcrumbs'
        const showModal = ref(false);

        onMounted(async () => {
            await getCatalog();
            await getCompanies();
        })

        function toggleModal(value: boolean) {
            showModal.value = value;
        }

        return {
            companies,
            breadcrumbUrl,
            loading,
            hasData,
            toggleModal,
            showModal
        }
    }
})
</script>

<style scoped>

</style>
