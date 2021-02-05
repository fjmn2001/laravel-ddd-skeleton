<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <div class="container-fluid mt-lg-5 mt-md-5 pt-lg-2 pt-md-2">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumb_url="breadcrumb_url"></breadcrums>
                <div class="div-title-table mt-3 pl-1 pr-1 pt-2 row" id="tags"
                     style="position: sticky; top: 3px; z-index: 2; border-right-style: none; border-right-color: #ffffff; border-left-style: none; border-left-color: #ffffff; margin-right: -16px; margin-left: -16px;">
                </div>
                <div class="d-datos-principal ml-n3 mr-n3">
                    <div class="pb-4">
                        <div class="align-items-center d-flex justify-content-between pt-sm-3 row">
                            <div class="d-flex pl-md-3">
                                <h4 class="ml-5 ml-md-4 pb-md-0" style="padding-left: 12px;">Detalles de la
                                    empresa</h4>
                            </div>
                        </div>
                        <div class="des01 pb-2 pl-4 pr-4">
                            <div class="mt-3 pl-3 pr-3 row">
                                <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
                                    <img src="@/assets/images/company.jpg"
                                         class="img-fluid img-thumbnail logo-empresa">
                                </div>
                                <div class="col-lg-9 col-md-6 col-sm-12 pt-4">
                                    <label>
                                        <label>Nombre de la empresa</label>
                                    </label>
                                    <input type="text" required="" class="form-control inp-filter">
                                    <div class="mt-3 row">
                                        <div class="col-lg-6 col-md-12">
                                            <label>Tipo de empresa</label>
                                            <input type="text" required="" class="form-control inp-filter">
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <label>Estado</label>
                                            <select required="" class="form-control inp-filter">
                                                <option value=""></option>
                                                <option value="1">option1</option>
                                                <option value="3">option2</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 pl-3 pr-3 row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <label>Dirección</label>
                                    <input type="text" required="" class="form-control inp-filter">
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <label>Teléfono</label>
                                    <input type="text" required="" class="form-control inp-filter">
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <label>Unidad de peso</label>
                                    <select class="form-control inp-filter">
                                        <option value=""></option>
                                        <option value="1">option1</option>
                                        <option value="2">option2</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <label>Retiene impuestos</label>
                                    <select class="form-control inp-filter">
                                        <option value=""></option>
                                        <option value="1">option1</option>
                                        <option value="2">option2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-3 pl-3 pr-3 row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <label>Código patronal</label>
                                    <input type="text" required="" class="form-control inp-filter">
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <label>Permitir crear facturas en periodos cerrados: </label>
                                    <input type="text" required="" class="form-control inp-filter">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label>Referencia&nbsp;</label>
                                    <input type="text" required="" class="form-control inp-filter">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-datos-principal ml-n3 mr-n3">
                    <div class="mt-3 pt-3">
                        <h4 class="ml-5 ml-md-4 pb-md-0" style="padding-left: 14px;">Políticas de cobros</h4>
                        <div class="des01 pb-3 pl-4 pr-4">
                            <div class="mt-3 pl-3 pr-3 row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="font-weight-bold">Permitir crear facturas en periodos
                                        cerrados&nbsp;</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control">
                                            <div class="input-group-addon" style="border-right: 1px solid #e5ebec;">
                                                <span>Días</span>
                                            </div>
                                        </div>
                                        <span
                                            class="help-block text-navy"><i><i>*Deje 0 si no quiere incluir un límite.</i></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-4 pr-0 pr-md-3 pt-3 row">
                <div class="col-6 col-md-2 col-sm-6 offset-md-8">
                    <button type="button" class="btn btn-block btn-outline-secondary mr-5 pl-3 pr-3"
                            style="margin: 10px 10px 10px 0px;">Cancelar
                    </button>
                </div>
                <div class="col-6 col-md-2 col-sm-6" style="margin-top: 3px;">
                    <button type="button" class="btn btn-block btn-blue-deg mb-2 mr-0 mr-md-5 mt-2"
                            style="height: 38px;">Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
import Breadcrums from '@/components/Breadcrums.vue';

@Component({
    components: {Breadcrums}
})

export default class Home extends Vue {
    breadcrumb_url = this.$store.state.ERP_URL + '/api/company/breadcrumbs'
}
</script>

<style scoped>

</style>
