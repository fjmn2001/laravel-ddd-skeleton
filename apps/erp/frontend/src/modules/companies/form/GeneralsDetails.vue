<template>

    <div class="xcontainer">
        <div class="align-items-center d-flex div-title-card justify-content-between row">
            <div class="align-items-baseline d-sm-flex flex-md-row flex-sm-column">
                <h5 class="xtitle-buscar">Detalles de la
                    empresa</h5>
                <p class="ml-md-3 ml-sm-0 pt-md-0 pt-sm-1 xsubtitle-buscar">(Formulario)</p>
            </div>
            <a href="#des01" id="desplegar-busqueda" data-toggle="collapse"><i class="fa fa-chevron-down"></i></a>
        </div>
        <div id="des01" class="des01 m-3 pb-3">
            <div class="mt-3 pl-3 pr-3 row">
                <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
                    <img src="@/assets/images/company.jpg"
                         class="img-fluid img-thumbnail logo-empresa">
                </div>
                <div class="col-lg-9 col-md-6 col-sm-12 pt-4">
                    <label>
                        <label>Nombre de la empresa *</label>
                    </label>
                    <input type="text" name="name" required="" v-model="name" class="form-control inp-filter">
                    <div class="mt-3 row">
                        <div class="col-lg-6 col-md-12">
                            <label>Tipo de empresa</label>
                            <input type="text" required="" class="form-control inp-filter" disabled>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <label>Estado *</label>
                            <select name="state" required="" v-model="state" class="form-control inp-filter">
                                <option value="">Seleccione</option>
                                <option value="active">Activo</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 pl-3 pr-3 row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label>Dirección *</label>
                    <input type="text" name="address" required="" v-model="address" class="form-control inp-filter">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label>Teléfono *</label>
                    <input type="text" required="" v-model="phone" class="form-control inp-filter">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label>Unidad de peso</label>
                    <select class="form-control inp-filter" disabled>
                        <option value=""></option>
                        <option value="1">option1</option>
                        <option value="2">option2</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label>Retiene impuestos</label>
                    <select class="form-control inp-filter" disabled>
                        <option value=""></option>
                        <option value="1">option1</option>
                        <option value="2">option2</option>
                    </select>
                </div>
            </div>
            <div class="mt-3 pl-3 pr-3 row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label>Código patronal</label>
                    <input type="text" class="form-control inp-filter" disabled>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label>Permitir crear facturas en periodos cerrados: </label>
                    <input type="text" required="" class="form-control inp-filter" disabled>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label>Referencia&nbsp;</label>
                    <input type="text" required="" class="form-control inp-filter" disabled>
                </div>
            </div>
        </div>
    </div>

</template>

<script lang="ts">
import {Component, Vue, Watch} from "vue-property-decorator";

@Component
export default class GeneralsDetails extends Vue {
    name = ''
    state = 'active'
    address = ''
    phone = ''

    mounted() {
        this.name = this.$store.state.companies.company.name;
        this.state = this.$store.state.companies.company.state;
        this.address = this.$store.state.companies.company.address;
        this.phone = this.$store.state.companies.company.phone;
    }

    @Watch('name')
    onNameChanged(val: string) {
        this.$store.state.companies.company.name = val;
    }

    @Watch('state')
    onStateChanged(val: string) {
        this.$store.state.companies.company.state = val;
    }

    @Watch('address')
    onAddressChanged(val: string) {
        this.$store.state.companies.company.address = val;
    }

    @Watch('phone')
    onPhoneChanged(val: string) {
        this.$store.state.companies.company.phone = val;
    }
}
</script>

<style scoped>

</style>
