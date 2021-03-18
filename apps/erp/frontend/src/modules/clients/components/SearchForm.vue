<template>
    <div>
        <div class="align-items-center d-flex div-title-card justify-content-between row">
            <div class="align-items-baseline d-sm-flex flex-md-row flex-sm-column">
                <h5 class="xtitle-buscar">Buscar cliente</h5>
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

<script lang="ts">
import {defineComponent, nextTick, ref} from 'vue'
import {useFilters} from "@/modules/clients/use/useFilters";
import {useClients} from "@/modules/clients/use/useClients";

export default defineComponent({
    emits: ['search'],
    setup() {
        const name = ref('');

        const {setFilters} = useFilters()
        const {loading, getClients} = useClients();


        async function search() {
            await setFilters([
                {field: 'name', value: name.value},
            ])
            getClients();
        }

        async function clean() {
            name.value = '';
            nextTick(() => {
                search();
            });
        }

        return {
            name,
            loading,
            search,
            clean,
        }
    }
});
</script>

<style scoped>

</style>
