<template>
    <div>
        <div class="xcontainer">
            <div class="align-items-center d-flex justify-content-between pt-sm-3 row">
                <div class="d-flex pl-md-3">
                    <h4 class="ml-5 ml-md-4 pb-md-0" style="padding-left: 12px;">Detalles del cliente</h4>
                </div>
            </div>
            <div class="des01 pb-4 pl-4 pr-4 pt-2">
                <div class="row pl-3 pr-3">
                    <div class="col-md-6">
                        <label>Nombre del cliente
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" v-model="name">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12" style="padding-bottom: 7px;">
                        <label>Identificación</label>
                        <span class="text-danger">*</span>
                        <select class="form-control inp-filter" v-model="clientType">
                            <option value="">Seleccione</option>
                            <option value="ruc">Jur&iacute;dica</option>
                            <option value="ruc_nt">Jur&iacute;dica NT</option>
                            <option value="cedula">Natural</option>
                            <option value="cedula_nt">Natural NT</option>
                            <option value="pasaporte">Pasaporte (Extranjero natural)</option>
                            <option value="otro">Extranjero (Jurídico)</option>
                            <option value="ong">ONG</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3 pl-3 pr-3 row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Tomo/Rollo ítem</label>
                        <input type="text" required="" class="form-control inp-filter" value="" disabled="">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Folio/Imagen/Documento&nbsp;</label>
                        <span class="text-danger">*</span>
                        <input type="text" required="" class="form-control inp-filter" disabled="">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Asiento/Ficha&nbsp;</label>
                        <span class="text-danger">*</span>
                        <input type="text" required="" class="form-control inp-filter" disabled="">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Dígito verificador&nbsp;</label>
                        <span class="text-danger">*</span>
                        <input type="text" required="" class="form-control inp-filter" disabled="">
                    </div>
                </div>

                <div class="mt-4 pl-3 pr-3 row">
                    <div class="col-md-3">
                        <label>Tipo de cliente</label>
                        <select class="form-control inp-filter" v-model="clientType">
                            <option value=""></option>
                            <option value="1">Opción01</option>
                            <option value="2">Opción01</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Categoría de cliente</label>
                        <select class="form-control inp-filter" v-model="clientCategory">
                            <option value=""></option>
                            <option value="1">Opción01</option>
                            <option value="1">Opción02</option>
                        </select>
                    </div>
                    <div class="col-md-3" id="div_limite_ventas">
                        <label>Límite de crédito de ventas</label>
                        <div class="input-group m-b">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control inp-filter" disabled="">
                        </div>
                    </div>
                    <div class="col-md-3" id="div_monto_tolerancia">
                        <label>Monto de tolerancia</label>
                        <div class="input-group m-b">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control inp-filter" disabled="">
                        </div>
                    </div>
                </div>
                <div class="mt-4 pl-3 pr-3 row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Antigüedad máxima (morosidad)</label>
                        <input type="text" required="" class="form-control inp-filter" disabled="">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label class="lbl-nombre">Toma de contacto</label>
                        <select required="" class="form-control inp-filter" disabled="">
                            <option value=""></option>
                            <option value="1">option1</option>
                            <option value="3">option2</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Requiere orden de compra</label>
                        <input type="text" required="" class="form-control inp-filter" disabled="">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label class="lbl-nombre">Estado&nbsp;</label>
                        <span class="text-danger">*</span>
                        <select required="" class="form-control inp-filter" v-model="state">
                            <option value=""></option>
                            <option value="1">option1</option>
                            <option value="3">option2</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 pl-3 pr-3 row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Cuenta por cobrar</label>
                        <select required="" class="form-control inp-filter" disabled="">
                            <option value=""></option>
                            <option value="1">option1</option>
                            <option value="3">option2</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Número de cliente frecuente</label>
                        <input type="text" required="" class="form-control inp-filter" v-model="frequentClientNumber">
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <label>Observaciones</label>
                        <textarea class="form-control text-area pinegrow-ui-helper-relative" rows="1" disabled=""></textarea>
                    </div>
                </div>
            </div>
        </div>
        <pre>{{client}}</pre>
    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref, watch} from "vue";
import {useClient} from "@/modules/clients/use/useClient";

export default defineComponent({
    setup() {
        const {client} = useClient();

        const name = ref('')
        const lastname = ref('')
        const dni = ref('')
        const dniType = ref('')
        const clientType = ref('')
        const clientCategory = ref('')
        const frequentClientNumber = ref('')
        const state = ref('active')


        onMounted(() => {
            name.value = client.value.name;
            lastname.value = client.value.lastname;
            dni.value = client.value.dni;
            dniType.value = client.value.dniType;
            clientType.value = client.value.clientType;
            clientCategory.value = client.value.clientCategory;
            frequentClientNumber.value = client.value.frequentClientNumber;
            state.value = client.value.state;
        })

        watch(() => name.value, val => client.value.name = val)
        watch(() => lastname.value, val => client.value.lastname = val)
        watch(() => dni.value, val => client.value.dni = val)
        watch(() => dniType.value, val => client.value.dniType = val)
        watch(() => clientType.value, val => client.value.clientType = val)
        watch(() => clientCategory.value, val => client.value.clientCategory = val)
        watch(() => frequentClientNumber.value, val => client.value.frequentClientNumber = val)
        watch(() => state.value, val => client.value.state = val)


        return {
            client,
            name,
            lastname,
            dni,
            dniType,
            clientType,
            clientCategory,
            frequentClientNumber,
            state,
        };
    }
});
</script>

<style scoped>

</style>
