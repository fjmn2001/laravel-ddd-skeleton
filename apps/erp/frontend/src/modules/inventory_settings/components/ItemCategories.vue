<template>
    <div class="config-div02 pr-5 pl-5 pt-4">
        <div class="pl-3 pl-md-2">
            <div class="d-flex pt-2 row">
                <div style="padding-left: 0px;" class="align-items-center col-md-12 d-flex">
                    <h5 class="d-inline ml-lg-0 ml-md-3 ml-sm-3 xtitle-buscar-guardar">Buscar y guardar&nbsp;
                        categorías de ítems</h5>
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
                    >Categorías de ítems</h5>
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
                        <span v-html="itemCategory.state" @click.prevent="changeState(itemCategory.id)"></span>
                    </td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-sm btn-opt" href="#" @click.prevent="showOptionsModal(itemCategory.id)">
                                <img src="@/assets/images/icons/3puntos_H.svg">
                            </a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <table-pager :totalRows="itemCategoriesCount"
                     @setFromPager="mySetFromPager"
                     v-show="itemCategories.length > 0 && !loading"></table-pager>
        <no-results v-if="itemCategories.length === 0 && !loading"></no-results>
        <loading v-if="loading"></loading>
        <options-modal :name="'optionsModal'"></options-modal>
    </div>
</template>

<script lang="ts">
import $ from 'jquery'
import {defineComponent, ref, Ref, onMounted, watch} from "vue";
import TablePager from "@/components/TablePager.vue"
import {ItemCategory} from "@/modules/inventory_settings/types/ItemCategory";
import NoResults from "@/components/table/NoResults.vue";
import Loading from "@/components/table/Loading.vue";
import {api} from "@/modules/inventory_settings/services/item_categories/api";
import {useItemCategoryFilters} from "@/modules/inventory_settings/use/useItemCategoryFilters";
import {useAuth} from "@/modules/auth/use/useAuth";
import {useItemCategory} from "@/modules/inventory_settings/use/useItemCatetory";
import OptionsModal from "@/components/modal/optionsModal.vue";
import {useModal} from "@/use/useModal";
import {Company} from "@/modules/auth/types/Company";

export default defineComponent({
    components: {OptionsModal, Loading, NoResults, TablePager},

    setup() {
        const itemCategories: Ref<ItemCategory[]> = ref([]);
        const itemCategoriesCount: Ref<number> = ref(0);
        const loading: Ref<boolean> = ref(true);
        const sending: Ref<boolean> = ref(false);
        const editing: Ref<boolean> = ref(false);
        const {setFilters, setFromPager} = useItemCategoryFilters();
        const {user} = useAuth();
        const {itemCategory, reset, create} = useItemCategory();
        const {show, populateLoading, populateBody, hide} = useModal();

        //..
        const name: Ref<string> = ref('');
        const description: Ref<string> = ref('');
        const state: Ref<string> = ref('');

        async function getItemCategories() {
            loading.value = true;
            setFromPager({pLimit: 10, pOffset: 0})
            itemCategories.value = await api.getItemCategories();
            itemCategoriesCount.value = await api.getItemCategoriesCount();
            loading.value = false;
        }

        async function mySetFromPager({pLimit, pOffset}: { pLimit: number, pOffset: number }) {
            setFromPager({pLimit, pOffset})
            itemCategories.value = await api.getItemCategories();
        }

        watch(() => name.value, (val) => itemCategory.value.name = val)
        watch(() => description.value, (val) => itemCategory.value.description = val)
        watch(() => state.value, (val) => itemCategory.value.state = val)
        //when changeCompany
        watch(() => user.value?.company, async (company: Company | undefined) => {
            if (company) {
                await setFilters([
                    {field: 'companyId', value: company.id}
                ]);
                await getItemCategories()
            }
        })


        async function myReset() {
            name.value = '';
            description.value = '';
            state.value = '';
            editing.value = false;
            reset();
            await setFilters([
                {field: 'companyId', value: user?.value?.company.id}
            ]);
            await getItemCategories()
        }

        async function submit() {
            try {
                sending.value = true
                if (editing.value) {
                    await api.updateItemCategory();
                } else {
                    await create()
                }

                myReset();
                await setFilters([
                    {field: 'companyId', value: user?.value?.company.id}
                ]);
                await getItemCategories()
            } catch (e) {
                console.log(e);
            } finally {
                sending.value = false
            }
        }

        onMounted(async () => {
            await setFilters([
                {field: 'companyId', value: user?.value?.company.id}
            ]);
            await getItemCategories();
        });

        async function changeState(id: string) {
            show('optionsModal')
            populateLoading('optionsModal')
            const modal = $('#optionsModal');
            const response = await api.getItemCategoryStates(id);
            populateBody('optionsModal', response)
            modal.off('click', '.updateState').on('click', '.updateState', async (e) => {
                populateLoading('optionsModal')
                await api.updateItemCategoryState(
                    $(e.target).data('id'),
                    $(e.target).data('state')
                )
                hide('optionsModal')
                await setFilters([
                    {field: 'companyId', value: user?.value?.company.id}
                ]);
                await getItemCategories();
            });
        }

        async function showOptionsModal(id: string) {
            show('optionsModal')
            populateLoading('optionsModal')

            const html = await api.getItemCategoryOptions(id)
            const modal = $('#optionsModal');

            populateBody('optionsModal', html)
            modal.off('click', '.edit').on('click', '.edit', async () => {
                populateLoading('optionsModal')
                const response = await api.findItemCategory(id);
                itemCategory.value = response
                name.value = response.name;
                description.value = response.description;
                state.value = response.state;
                editing.value = true;
                hide('optionsModal')
            });

            modal.off('click', '.changeState').on('click', '.changeState', async () => {
                hide('optionsModal')
                changeState(id)
            });
        }

        async function search() {
            await setFilters([
                {field: 'companyId', value: user?.value?.company.id},
                {field: 'name', value: name.value},
                {field: 'description', value: description.value},
                {field: 'state', value: state}
            ]);
            await getItemCategories()
        }

        return {
            name,
            description,
            state,
            itemCategories,
            loading,
            sending,
            itemCategoriesCount,
            submit,
            myReset,
            showOptionsModal,
            search,
            changeState,
            mySetFromPager
        }
    }
})
</script>

<style scoped>

</style>
