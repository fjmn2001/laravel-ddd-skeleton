<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <div class="container-fluid main-conta">
            <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>

            <div class="xcontainer">
                <div class="row" id="config01">
                    <div class="config-div01 pl-5">
                        <button type="button" id="menu-config-collapse" class="bnt-config btn ml-md-2 ml-sm-3 mt-sm-3">
                            <i class="icon-settings" style="color: #576984;"></i>
                            <span>Menu de configuraciones</span>
                        </button>
                        <div id="menu-config">
                            <ul class="list-unstyled components">
                                <li class="active">
                                    <a href="javascript:void(0)">Categorías de ítems</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Tipos de ubicación</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Unidades de lectura</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="config-div02 pl-sm-5 pr-sm-5">
                        <div class="pl-3 pl-md-2">
                            <div class="d-flex pt-2 row">
                                <div style="padding-left: 0px;" class="align-items-center col-md-12 d-flex">
                                    <h5 class="d-inline ml-lg-0 ml-md-3 ml-sm-3 xtitle-buscar-guardar">Buscar y guardar&nbsp;
                                        categorías de ítems</h5>
                                </div>
                            </div>
                            <div id="des01" class="des01 mb-3 ml-0 mr-3 mt-2">
                                <div class=" row">
                                    <div class="col-lg-3 col-md-6 col-sm-12 pl-3 pl-lg-0 pl-md-3">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control inp-filter">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 ">
                                        <label>Descripción</label>
                                        <input type="text" class="form-control inp-filter">
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 pr-lg-0">
                                        <label>Estado</label>
                                        <select class="form-control inp-filter">
                                            <option value="1">Activo</option>
                                            <option value="2">Desactivado</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-2 row" style="width: 100%;">
                                    <div
                                        class="col-lg-7 col-md-8 col-xl-6 d-flex justify-content-around offset-lg-5 offset-md-4 offset-xl-6">
                                        <button type="button" class="btn btn-blue2-deg btn-sm pl-3 pr-3">Buscar</button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm mr-0 pl-3 pr-3"
                                                style="margin: 10px 0px; min-width: 100px;">Cancelar
                                        </button>
                                        <button type="button" class="btn btn-blue-deg btn-sm pl-3 pr-3">Guardar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex pt-2 row">
                                <div style="padding-left: 0px;" class="align-items-center col-md-12 d-flex mb-2">
                                    <h5 class="d-inline ml-4 ml-lg-3 ml-md-3 ml-sm-2 xtitle-buscar"
                                        style="padding-bottom: 0px;">Categorías de ítems</h5>
                                </div>
                            </div>
                        </div>
                        <div class=" pl-2 pr-2 table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Meses a depreciar</th>
                                    <th>Porcentaje de depreciación</th>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Ítems inventariado</td>
                                    <td>Ítems guardados en bodega</td>
                                    <td>5 Meses</td>
                                    <td>50%</td>
                                    <td>
                                        <button type="button" class="btn btn-green btn-sm btn-table">Activo</button>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ítems no inventariado</td>
                                    <td>No guardados</td>
                                    <td>3 Meses</td>
                                    <td>20%</td>
                                    <td>
                                        <button type="button" class="btn btn-red btn-sm btn-table">Desactivado</button>
                                        &nbsp;
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <table-pager></table-pager>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import Breadcrums from '@/components/Breadcrums.vue';
import {useCore} from "@/modules/shared/use/useCore";
import TablePager from "@/components/TablePager.vue";

export default defineComponent({
    components: {TablePager, Breadcrums},
    setup() {
        const {ERP_URL} = useCore();
        const breadcrumbUrl: string = ERP_URL + '/api/company/breadcrumbs'

        return {
            breadcrumbUrl
        }
    }
})
</script>

<style scoped>

</style>
