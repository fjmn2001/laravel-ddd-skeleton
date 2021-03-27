<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <div class="container-fluid main-conta">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>

                <div class=" xcontainer">
                    <search-form></search-form>
                </div>
                <div class=" xcontainer">
                    <div>
                        <div class="align-items-center d-flex div-title-card justify-content-between row">
                            <div class="align-items-baseline d-sm-flex flex-md-row flex-sm-column">
                                <h5 class="xtitle-buscar">List of items </h5>
                                <p class="ml-md-3 ml-sm-0 pt-md-0 pt-sm-1 xsubtitle-buscar">(Main table)</p>
                            </div>
                            <a href="#des02" id="desplegar-busqueda1" data-toggle="collapse"><i
                                class="fa fa-chevron-up"></i></a>
                        </div>

                        <div id="des02" class="pb-3 pl-4 pr-4 pt-3" v-if="hasData() && !loading">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th id="th-ini-sd">
                                            <input type="checkbox" class="chk">
                                        </th>
                                        <th>No. item<i class="fa fa-sort thead-i"></i></th>
                                        <th>Name<i class="fa fa-sort thead-i"></i></th>
                                        <th>Category<i class="fa fa-caret-down thead-i"></i></th>
                                        <th>Average cost<i class="fa fa-caret-down thead-i"></i></th>
                                        <th>State<i class="fa fa-caret-up thead-i"></i></th>
                                        <th>Options</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in items" :key="item.id">
                                        <th>
                                            <input type="checkbox" class="chk">
                                        </th>
                                        <td>
                                            <router-link
                                                :to="{name: 'items.edit', params:{id: item.id}}">
                                                {{ item.code }}
                                            </router-link>
                                        </td>
                                        <td>
                                            <router-link
                                                :to="{name: 'items.edit', params:{id: item.id}}">
                                                {{ item.name }}
                                            </router-link>
                                        </td>
                                        <td v-text="item.categoryId"></td>
                                        <td v-html="item.averageCost"></td>
                                        <td>
                                            <span v-html="item.state" @click.prevent="changeState(item.id)"></span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-opt" href="#"
                                                   @click.prevent="showOptionsModal(item.id)">
                                                    <img src="@/assets/images/icons/3puntos_H.svg">
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <table-pager :totalRows="itemsCount"
                                     @setFromPager="mySetFromPager"
                                     v-show="hasData() && !loading"></table-pager>
                        <no-results v-if="!hasData() && !loading"></no-results>
                        <loading v-if="loading"></loading>
                        <options-modal :name="'optionsModal'"></options-modal>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref, watch} from 'vue'
import Breadcrums from '@/components/Breadcrums.vue';
import SearchForm from "@/modules/items/components/SearchForm.vue";
import {useItems} from "@/modules/items/use/useItems";
import {useCatalog} from "@/modules/items/use/useCatalog";
import {useCore} from "@/modules/shared/use/useCore";
import TablePager from "@/components/TablePager.vue";
import NoResults from "@/components/table/NoResults.vue";
import Loading from "@/components/table/Loading.vue";
import {useFilters} from "@/modules/items/use/useFilters";
import {useAuth} from "@/modules/auth/use/useAuth";
import $ from "jquery";
import {api} from "@/modules/items/services/api";
import {useModal} from "@/use/useModal";
import OptionsModal from "@/components/modal/optionsModal.vue";
import router from "@/router";
import {Company} from "@/modules/auth/types/Company";

export default defineComponent({
    components: {Loading, NoResults, TablePager, SearchForm, Breadcrums, OptionsModal},
    setup() {
        const {ERP_URL} = useCore();
        const {items, hasData, loading, getItems, itemsCount} = useItems();
        const {setFilters, setFromPager} = useFilters();
        const {user} = useAuth();
        const {getCatalog} = useCatalog();
        const breadcrumbUrl: string = ERP_URL + '/api/items/breadcrumbs'
        const showModal = ref(false);
        const {show, populateLoading, populateBody, hide} = useModal();

        async function initComponent() {
            await getCatalog();
            await setFilters([
                {field: 'companyId', value: user?.value?.company.id}
            ]);
            setFromPager({pLimit: 10, pOffset: 0})
            await getItems();
        }

        async function mySetFromPager({pLimit, pOffset}: { pLimit: number, pOffset: number }) {
            setFromPager({pLimit, pOffset})
            await getItems();
        }

        onMounted(async () => {
            initComponent();
        })

        //when changeCompany
        watch(() => user.value?.company, async (company: Company | undefined) => {
            if (company) {
                initComponent()
            }
        })

        async function changeState(id: string) {
            show('optionsModal')
            populateLoading('optionsModal')
            const modal = $('#optionsModal');
            const response = await api.getItemStates(id);
            populateBody('optionsModal', response)
            modal.off('click', '.updateState').on('click', '.updateState', async (e) => {
                populateLoading('optionsModal')
                await api.updateItemState(
                    $(e.target).data('id'),
                    $(e.target).data('state')
                )
                hide('optionsModal')
                await setFilters([
                    {field: 'companyId', value: user?.value?.company.id}
                ]);
                await getItems();
            });
        }

        async function showOptionsModal(id: string) {
            show('optionsModal')
            populateLoading('optionsModal')

            const html = await api.getItemOptions(id)
            const modal = $('#optionsModal');

            populateBody('optionsModal', html)

            modal.off('click', '.edit').on('click', '.edit', async () => {
                hide('optionsModal')
                router.push({name: 'items.edit', params: {id}});
            });

            modal.off('click', '.changeState').on('click', '.changeState', async () => {
                hide('optionsModal')
                changeState(id)
            });
        }

        function toggleModal(value: boolean) {
            showModal.value = value;
        }

        return {
            items,
            itemsCount,
            breadcrumbUrl,
            loading,
            hasData,
            toggleModal,
            changeState,
            showOptionsModal,
            mySetFromPager,
            showModal
        }
    }
})
</script>

<style scoped>

</style>
