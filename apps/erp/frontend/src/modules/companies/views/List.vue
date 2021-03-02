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
                                                    v-html="company.stateValue"></button>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-opt" href="#" role="button" id="dropdownMenu1"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="@/assets/images/icons/3puntos_H.svg"> </a>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="dropdownMenu1">
                                                    <a class="dropdown-item" href="#">Duplicar</a>
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
                                    class="align-items-center col-md-6 d-flex justify-content-center offset-md-3 pb-3 pt-3 pagination">
                                    <a class="btn btn-cicle"><img src="@/assets/images/icons/two-arrow-left.svg"></a>
                                    <a class="btn btn-cicle"><img src="@/assets/images/icons/one-arrow-left.svg"
                                                                  style="width: 0.4rem;"></a>
                                    <p class="p-pag">Página <input type="text" value="1" class="inp-pag">&nbsp;de 6</p>
                                    <a class="btn btn-cicle"><img src="@/assets/images/icons/one-arrow-right.svg"
                                                                  style="width: 0.4rem;"></a>
                                    <a class="btn btn-cicle"><img src="@/assets/images/icons/two-arrow-right.svg"></a>
                                    <select class="inp-pag sel-pag">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="align-items-center col-md-3 d-flex justify-content-end pb-3 pt-3">
                                    <p class="mr-4 p-pag">Mostrando 1 - 10 de 20</p>
                                </div>
                            </div>
                        </div>
                        <div class="pb-4 pl-4 pr-4 pt-4" v-if="!hasData() && !loading">
                            <div class="no-resul">
                                <i class="icon-doc color-blue1"></i>
                                <h2>No se encontró ningún registro.</h2>
                            </div>
                        </div>
                        <div class="pb-4 pl-4 pr-4 pt-3" v-if="loading">
                            <div class="pb-3 pl-4 pr-4 pre-loader pt-3">
                                <div class="table-responsive">
                                    <div class="l-hear">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <div class="l-bod l-hear">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                                <div class="justify-content-center mt-0 pt-0 row">
                                    <div
                                        class="align-items-center col-md-6 d-flex justify-content-center offset-md-3 pb-3 pt-3 pagination">
                                        <a class="btn btn-cicle"></a>
                                        <a class="btn btn-cicle"></a>
                                        <p class="p-pag">Página &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                        <a class="btn btn-cicle"></a>
                                        <a class="btn btn-cicle"></a>
                                        <input type="text" class="inp-pag" style="margin-left: 7px;">
                                    </div>
                                    <div class="align-items-center col-md-3 d-flex justify-content-end pb-3 pt-3">
                                        <p class="mr-4 p-pag">Mostrando 1 - 10 de 20</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" @click.prevent="toggleModal(true)">Show modal</button>
        <teleport to="body">
            <div class="modal fade" :class="{show: showModal}" tabindex="-1"
                 :style="{display: showModal ? 'block' : 'none'}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    @click.prevent="toggleModal(false)"></button>
                        </div>
                        <div class="modal-body">
                            <p>Modal body text goes here.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click.prevent="toggleModal(false)">Close
                            </button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </teleport>
    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref} from 'vue'
import {useStore} from 'vuex'
import Breadcrums from '@/components/Breadcrums.vue';
import SearchForm from "@/modules/companies/components/SearchForm.vue";
import {useCompanies} from "@/modules/companies/use/useCompanies";
import {useCatalog} from "@/modules/companies/use/useCatalog";

export default defineComponent({
    components: {SearchForm, Breadcrums},
    setup() {
        const store = useStore()
        const {companies, hasData, loading, getCompanies} = useCompanies();
        const {getCatalog} = useCatalog();
        const breadcrumbUrl: string = store.state.ERP_URL + '/api/company/breadcrumbs'
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
            store,
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
