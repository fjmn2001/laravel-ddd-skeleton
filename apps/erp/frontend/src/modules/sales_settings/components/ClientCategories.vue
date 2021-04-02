<template>
    <div class="config-div02 pr-5 pl-5 pt-4">
        <div class="pl-3 pl-md-2">
            <div class="d-flex pt-2 row">
                <div style="padding-left: 0px;" class="align-items-center col-md-12 d-flex">
                    <h5 class="d-inline ml-lg-0 ml-md-3 ml-sm-3 xtitle-buscar-guardar">Buscar y guardar&nbsp;
                        categorías de cliente</h5>
                </div>
            </div>

            <form class="des01 mb-3 ml-0 mr-3 mt-3" @submit.prevent="submit" autocomplete="off">
                <div class=" row">
                    <div class="col-lg-3 col-md-6 col-sm-12 pl-3 pl-lg-0 pl-md-3">
                        <label>Nombre *</label>
                        <input type="text" name="name" v-model="name" required="" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 ">
                        <label>Descripción</label>
                        <input type="text" name="description" v-model="description" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 pr-lg-0">
                        <label>Estado *</label>
                        <select name="state" required="" class="form-control inp-filter" v-model="state">
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="mt-3 row" style="width: 100%;">
                    <div
                        class="col-lg-7 col-md-8 col-xl-6 d-flex justify-content-around offset-lg-5 offset-md-4 offset-xl-6">
                        <button type="button" class="btn btn-blue2-deg btn-sm pl-3 pr-3" :disabled="sending"
                                @click.prevent="search">Buscar
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm mr-0 pl-3 pr-3"
                                style="margin: 10px 0px; min-width: 100px;" @click="myReset" :disabled="sending">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-blue-deg btn-sm pl-3 pr-3" :disabled="sending">Guardar
                        </button>
                    </div>
                </div>

            </form>

            <div class="d-flex pt-1 row">
                <div style="padding-left: 0px;" class="align-items-center col-md-12 d-flex mb-2">
                    <h5 class="d-inline ml-4 ml-lg-3 ml-md-3 ml-sm-2 xtitle-buscar"
                    >Categorías de cliente</h5>
                </div>
            </div>
        </div>

        <div class=" pl-2 pr-2 table-responsive" v-if="ClientCategories.length > 0 && !loading">
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
                    <tr v-for="ClientCategory in ClientCategories" :key="ClientCategory.id">
                        <td></td>
                        <td v-html="ClientCategory.name"></td>
                        <td v-html="ClientCategory.description"></td>
                        <td>
                            <span v-html="ClientCategory.state" @click.prevent="changeState(ClientCategory.id)"></span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-sm btn-opt" href="#" @click.prevent="showOptionsModal(ClientCategory.id)">
                                    <img src="@/assets/images/icons/3puntos_H.svg">
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <no-results v-if="ClientCategories.length === 0 && !loading"></no-results>
        <loading v-if="loading"></loading>
    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref, Ref, watch} from "vue";
import toastr from "toastr";

import {Company} from "@/modules/auth/types/Company";
import {useAuth} from "@/modules/auth/use/useAuth";
import {useClientCategory} from "@/modules/sales_settings/use/useClientCategory/useClientCategory";
import {ClientCategory} from "@/modules/sales_settings/types/ClientCategory";

import Loading from "@/components/table/Loading.vue";
import NoResults from "@/components/table/NoResults.vue";
import {useItemCategoryFilters} from "@/modules/inventory_settings/use/useItemCategoryFilters";
import {api} from "@/modules/sales_settings/services/client_category/api";

export default defineComponent({
    components: {Loading, NoResults},

    setup() {
        const {user} = useAuth();
        const {create, clientCategory, reset} = useClientCategory();
        const ClientCategories: Ref<ClientCategory[]> = ref([]);

        const {setFilters} = useItemCategoryFilters();

        const loading: Ref<boolean> = ref(true);
        const sending: Ref<boolean> = ref(false);
        const editing: Ref<boolean> = ref(false);

        //..
        const name: Ref<string> = ref('');
        const description: Ref<string> = ref('');
        const state: Ref<string> = ref('active');

        async function getClientCategory() {
            loading.value = true;
            ClientCategories.value = await api.getClientCategories();
            loading.value = false;
        }

        watch(() => name.value, (val) => clientCategory.value.name = val)
        watch(() => description.value, (val) => clientCategory.value.description = val)
        watch(() => state.value, (val) => clientCategory.value.state = val)
        //when changeCompany
        watch(() => user.value?.company, async (company: Company | undefined) => {
            if (company) {
                await setFilters([
                    {field: 'companyId', value: company.id}
                ]);
                await getClientCategory();
            }
        })

        async function myReset() {
            name.value = '';
            description.value = '';
            state.value = 'active';
            editing.value = false;
            reset();
            await setFilters([
                {field: 'companyId', value: user?.value?.company.id}
            ]);
            await getClientCategory()
        }

        async function submit() {
            try {
                sending.value = true
                if (editing.value) {
                    console.log('edit');
                } else {
                    await create()
                    toastr.success("Su solicitud se ha procesado correctamente.");
                    await myReset();
                }
            } catch (e) {
                toastr.error(e?.response?.data?.message);
                console.log(e);
            } finally {
                sending.value = false
            }
        }

        async function search() {
            await setFilters([
                {field: 'companyId', value: user?.value?.company.id},
                {field: 'name', value: name.value},
                {field: 'description', value: description.value},
                {field: 'state', value: state}
            ]);
            await getClientCategory()
        }

        async function changeState() {
            console.log('search')
        }

        async function showOptionsModal() {
            console.log('search')
        }

        onMounted(async () => {
            await setFilters([
                {field: 'companyId', value: user?.value?.company.id}
            ]);
            await getClientCategory();
        });

        return {
            name,
            description,
            state,
            ClientCategories,

            loading,
            sending,
            editing,

            submit,
            myReset,
            search,
            changeState,
            showOptionsModal,
        }
    }
});
</script>

<style scoped>

</style>
