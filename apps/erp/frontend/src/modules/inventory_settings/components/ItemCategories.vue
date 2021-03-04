<template>
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
        <div class=" pl-2 pr-2 table-responsive" v-if="itemCategories.length > 0 && !loading">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="itemCategory in itemCategories" :key="itemCategory.id">
                    <td></td>
                    <td v-html="itemCategory.name"></td>
                    <td v-html="itemCategory.description"></td>
                    <td>
                        <button type="button" class="btn btn-green btn-sm btn-table"
                                v-html="itemCategory.state"></button>
                    </td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-sm btn-opt" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="@/assets/images/icons/3puntos_H.svg"> </a>
                            <div class="dropdown-menu dropdown-menu-right"
                                 aria-labelledby="dropdownMenu1">
                                <a class="dropdown-item" href="#">Duplicar</a>
                                <a class="dropdown-item" href="#">Copiar</a>
                                <a class="dropdown-item" href="#">Eliminar</a>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <table-pager v-if="itemCategories.length > 0 && !loading"></table-pager>
        <no-results v-if="itemCategories.length === 0 && !loading"></no-results>
        <loading v-if="loading"></loading>
    </div>
</template>

<script lang="ts">
import {defineComponent, ref, Ref, onMounted} from "vue";
import TablePager from "@/components/TablePager.vue"
import {ItemCategory} from "@/modules/inventory_settings/types/ItemCategory";
import NoResults from "@/components/table/NoResults.vue";
import Loading from "@/components/table/Loading.vue";
import {api} from "@/modules/inventory_settings/services/api";
import {useItemCategoryFilters} from "@/modules/inventory_settings/use/useItemCategoryFilters";
import {useAuth} from "@/modules/auth/use/useAuth";

export default defineComponent({
    components: {Loading, NoResults, TablePager},

    setup() {
        const itemCategories: Ref<ItemCategory[]> = ref([]);
        const loading: Ref<boolean> = ref(true);
        const {setFilters} = useItemCategoryFilters();
        const {user} = useAuth();

        async function getItemCategories() {
            itemCategories.value = await api.getItemCategories();
        }

        onMounted(async () => {
            await setFilters([
                {field: 'companyId', value: user?.value?.company.id}
            ]);
            await getItemCategories();
            loading.value = false;
        });

        return {
            itemCategories,
            loading
        }
    }
})
</script>

<style scoped>

</style>
