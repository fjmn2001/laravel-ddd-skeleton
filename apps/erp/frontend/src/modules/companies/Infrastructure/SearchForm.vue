<template>
    <div class="mt-4">
        <div class="align-items-center d-flex justify-content-between pt-3 row">
            <div class="align-items-baseline d-sm-flex flex-md-row flex-sm-column"
                 style="padding-left: 27px;">
                <h5 class="xtitle-buscar" style="margin-left: 20px;">Buscar empresa</h5>
                <p class="ml-3 ml-lg-0 xsubtitle-buscar">(Búsqueda avanzada)</p>
            </div>
            <a href="#des01" id="desplegar-busqueda" class="arrow-left icon mr-5 collapsed"
               data-toggle="collapse" aria-expanded="false"></a>
        </div>
        <div id="des01" class="des01 m-3 collapse" style="">
            <div class="pb-1 pl-3 pr-3 pt-2 row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <label>Nombre de la empresa</label>
                    <input type="text" class="form-control inp-filter" v-model="name">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12" style="margin-left: 0px;">
                    <label>Estado</label>
                    <v-select multiple :options="[{label: 'Activa', id: 'active'}, {label: 'Inactiva', id: 'inactive'}]"
                              v-model="state"
                              :reduce="option => option.id"></v-select>
                </div>
            </div>
            <div class="row pt-3">
                <div
                    class="col-lg-3 col-md-4 col-sm-12 d-flex justify-content-center offset-lg-9 offset-md-8 offset-sm-0">
                    <button type="button" class="btn btn-blue-deg btn-sm mr-5 pl-3 pr-3" :disabled="loading()"
                            @click.prevent="search">Buscar
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm mr-0 pl-3 pr-3"
                            style="margin: 10px 10px 10px 0px; min-width: 100px;" @click.prevent="clean">Limpiar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator'

@Component
export default class SearchForm extends Vue {
    name = ''
    state = []

    async search() {
        await this.$store.dispatch('companies/changeFilters', [
            {field: 'name', value: this.name},
            {field: 'state', value: this.state}
        ]);
        await this.$store.dispatch('companies/companySearcher');
    }

    async clean() {
        this.name = ''
        this.state = []
        Vue.nextTick(() => {
            this.search();
        });
    }

    loading(): boolean {
        return this.$store.state.companies.loading;
    }
}
</script>

<style scoped>

</style>
