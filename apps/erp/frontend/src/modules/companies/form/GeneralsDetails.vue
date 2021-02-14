<template>
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
        console.log(this.$store.state.companies.company.name, 'hi there!');
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
