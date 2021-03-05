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
                <div class="col-lg-3 col-md-3 col-sm-12" v-if="catalogs">
                    <label>Estado</label>
                    <select2 name="state" :config="{}" :attr="{multiple: true}" v-model="state">
                        <option :value="state.id" v-for="state in catalogs.states" v-html="state.title"
                                :key="state.id"></option>
                    </select2>
                </div>
            </div>
            <div class="row pt-3">
                <div
                    class="col-lg-3 col-md-4 col-sm-12 d-flex justify-content-center offset-lg-8 offset-md-7 offset-sm-0">
                    <button type="button" class="btn btn-blue-deg btn-sm mr-1 mr-lg-5" :disabled="loading"
                            @click.prevent="search">Buscar
                    </button>
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
import {useCompanies} from "@/modules/companies/use/useCompanies";
import {useFilters} from "@/modules/companies/use/useFilters";
import {useCatalog} from "@/modules/companies/use/useCatalog";

export default defineComponent({
    emits: ['search'],
    setup() {
        const {setFilters} = useFilters()
        const {loading, getCompanies} = useCompanies();
        const {catalogs} = useCatalog();

        const name = ref('')
        const state = ref([])

        async function search() {
            await setFilters([
                {field: 'name', value: name.value},
                {field: 'state', value: state.value}
            ])
            getCompanies();
        }

        async function clean() {
            name.value = ''
            state.value = []
            nextTick(() => {
                search();
            });
        }

        return {
            name,
            state,
            search,
            clean,
            loading,
            catalogs
        };
    }
})
</script>

<style scoped>

</style>
