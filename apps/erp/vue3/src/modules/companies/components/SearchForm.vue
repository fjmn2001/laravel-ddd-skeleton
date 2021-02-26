<template>
    <div>
        <div class="align-items-center d-flex div-title-card justify-content-between row">
            <div class="align-items-baseline d-sm-flex flex-md-row flex-sm-column">
                <h5 class="xtitle-buscar">Buscar empresa</h5>
                <p class="ml-md-3 ml-sm-0 pt-md-0 pt-sm-1 xsubtitle-buscar">(Búsqueda avanzada)</p>
            </div>
            <a href="#des01" id="desplegar-busqueda" data-toggle="collapse"><i class="fa fa-chevron-down"></i></a>
        </div>
        <div id="des01" class="des01 m-3 pb-3 collapse">
            <div class="pb-1 pl-3 pr-3 pt-2 row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <label>Nombre de la empresa</label>
                    <input type="text" class="form-control inp-filter" v-model="name">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12" style="margin-left: 0px;">
                    <label>Estado</label>
                    <!--                    <v-select multiple :options="[{label: 'Activa', id: 'active'}, {label: 'Inactiva', id: 'inactive'}]"-->
                    <!--                              v-model="state"-->
                    <!--                              :reduce="option => option.id">-->
                    <!--                    </v-select>-->
                </div>
            </div>
            <div class="row pt-3">
                <div
                    class="col-lg-3 col-md-4 col-sm-12 d-flex justify-content-center offset-lg-8 offset-md-7 offset-sm-0">
                    <a type="button" class="btn btn-blue-deg btn-sm disabled mr-1 mr-lg-5" :disabled="loading()"
                       @click.prevent="search">Buscar</a>
                    <button type="button" class="btn btn-outline-secondary btn-sm mr-0 pl-3 pr-3 limpia"
                            @click.prevent="clean">Limpiar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {defineComponent, ref, nextTick} from 'vue'
import {useStore} from 'vuex'

export default defineComponent({
    setup() {
        const store = useStore()

        const name = ref('')
        const state = ref([])

        async function search() {
            await store.dispatch('companies/changeFilters', [
                {field: 'name', value: name.value},
                {field: 'state', value: state.value}
            ]);
            store.dispatch('companies/companySearcher');
        }

        async function clean() {
            name.value = ''
            state.value = []
            nextTick(() => {
                search();
            });
        }

        function loading() {
            return store.state.companies.loading;
        }

        return {
            name,
            state,
            search,
            clean,
            loading
        };
    }
})
</script>

<style scoped>

</style>
