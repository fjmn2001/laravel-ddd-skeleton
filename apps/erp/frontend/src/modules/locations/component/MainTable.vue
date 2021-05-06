<template>
    <div class="xcontainer">
        <div>
            <div class="align-items-center d-flex div-title-card justify-content-between row">
                <div class="align-items-baseline d-sm-flex flex-md-row flex-sm-column">
                    <h5 class="xtitle-buscar">List of locations </h5>
                    <p class="ml-md-3 ml-sm-0 pt-md-0 pt-sm-1 xsubtitle-buscar">(Main table)</p>
                </div>
                <a href="#des02" id="desplegar-busqueda1" data-toggle="collapse"><i
                    class="fa fa-chevron-up"></i></a>
            </div>

            <div id="des02" class="pb-3 pl-4 pr-4 pt-3" v-if="showRows()">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th id="th-ini-sd">
                                <input type="checkbox" class="chk">
                            </th>
                            <th>No. location<i class="fa fa-sort thead-i"></i></th>
                            <th>Name<i class="fa fa-sort thead-i"></i></th>
                            <th>Main contact<i class="fa fa-caret-down thead-i"></i></th>
                            <th>State<i class="fa fa-caret-up thead-i"></i></th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="location in locations" :key="location.id">
                            <th>
                                <input type="checkbox" class="chk">
                            </th>
                            <td>
                                <router-link
                                    :to="{name: 'items.edit', params:{id: location.id}}">
                                    {{ location.code }}
                                </router-link>
                            </td>
                            <td>
                                <router-link
                                    :to="{name: 'items.edit', params:{id: location.id}}">
                                    {{ location.name }}
                                </router-link>
                            </td>
                            <td v-text="location.mainContact"></td>
                            <td>
                                <span v-html="location.state" @click.prevent="changeState(location.id)"></span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-opt" href="#"
                                       @click.prevent="showOptionsModal(location.id)">
                                        <img src="@/assets/images/icons/3puntos_H.svg" alt="options">
                                    </a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <table-pager :totalRows="count"
                         @setFromPager="mySetFromPager"
                         v-show="showRows()"></table-pager>
            <no-results v-if="showNoResults()"></no-results>
            <loading v-if="loading"></loading>
            <options-modal :name="'optionsModal'"></options-modal>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import TablePager from "@/components/TablePager.vue";
import NoResults from "@/components/table/NoResults.vue";
import Loading from "@/components/table/Loading.vue";
import OptionsModal from "@/components/modal/optionsModal.vue";
import {useLocations} from "@/modules/locations/use/useLocations";

export default defineComponent({
    components: {TablePager, NoResults, Loading, OptionsModal},
    setup() {
        const {locations, count, loading, showRows, showNoResults} = useLocations()

        function mySetFromPager() {
            console.log('set from pager')
        }

        function changeState() {
            console.log('change state')
        }

        function showOptionsModal() {
            console.log('show option')
        }

        return {
            locations,
            count,
            loading,
            mySetFromPager,
            changeState,
            showOptionsModal,
            showRows,
            showNoResults
        }
    }
})
</script>

<style scoped>

</style>
