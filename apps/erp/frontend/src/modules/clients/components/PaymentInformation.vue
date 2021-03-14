<template>
    <div class="xcontainer">
        <div class="mt-3">
            <div class="align-items-center d-flex justify-content-between pl-sm-3 pr-sm-3 pt-sm-3 row">
                <div class="d-flex">
                    <h4 class="ml-5 ml-md-4 pb-md-0" style="padding-left: 14px;">Información de pago</h4>
                </div>
            </div>
            <div class="des01 pb-4 pl-4 pr-4">
                <div class="mt-3 pl-3 pr-3 row">
                    <div class="col-md-3">
                        <label>Exonerado de impuesto</label>
                        <div class="input-group" disabled="">
                            <span class="input-group-addon"> <input type="checkbox" name="exonerado_check"> </span>
                            <input type="text" name="campo[exonerado_impuesto]" class="form-control" placeholder="Ingrese número de certificado" disabled="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Retiene impuestos</label>
                        <select class="form-control" disabled="">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                    </div>
                    <div class="col-md-3" style="display: none;">
                        <label>Objeto de la retención</label>
                        <select class="form-control" name="campo[objeto_retencion]" config="[object Object]" disabled="">
                            <option value=""></option>
                            <option value="1" key="0">PAGO POR SERVICIO PROFESIONAL AL ESTADO 100%</option>
                            <option value="2" key="1">PAGO POR VENTA DE BIENES/SERVICIOS AL ESTADO 50%</option>
                            <option value="3" key="2">PAGO O ACREDITACION NO DOMICILIADO O EMPRESA EN EL EXTERIOR 100%</option>
                        </select>
                    </div>
                    <div class="col-md-3" id="div_lista_precio_venta">
                        <label>Lista de precio de ventas</label>
                        <select class="form-control" disabled="">
                            <option value=""></option>
                            <option value="33">Regular</option>
                            <option value="140">PRECIO BASE</option>
                            <option value="161">Precio específico</option>
                        </select>
                    </div>
                    <div class="col-md-3" id="div_lista_precio_alquiler">
                        <label>Lista de precio de alquiler</label>
                        <select class="form-control" disabled="">
                            <option value=""></option>
                            <option value="141">Regular</option>
                            <option value="142">precio base</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3 pl-3 pr-3 row">
                    <div class="col-md-3" style="display: none;">
                        <label>Objeto de la retención</label>
                        <select class="form-control" name="campo[objeto_retencion]" disabled="" config="[object Object]">
                            <option value=""></option>
                            <option value="1" key="0">PAGO POR SERVICIO PROFESIONAL AL ESTADO 100%</option>
                            <option value="2" key="1">PAGO POR VENTA DE BIENES/SERVICIOS AL ESTADO 50%</option>
                            <option value="3" key="2">PAGO O ACREDITACION NO DOMICILIADO O EMPRESA EN EL EXTERIOR 100%</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Términos de pago</label>
                        <select class="form-control" disabled="">
                            <option value=""></option>
                            <option value="141">Regular</option>
                            <option value="142">precio base</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";

export default defineComponent({
    setup() {
        return [];
    }
})
</script>

<style scoped>

</style>
