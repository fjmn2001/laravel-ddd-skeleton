<template>
    <div class="xcontainer">
        <div>
            <div class="align-items-center d-flex div-title-card justify-content-between row">
                <div class="align-items-baseline d-sm-flex flex-md-row flex-sm-column">
                    <h5 class="xtitle-buscar">List of locations </h5>
                    <p class="ml-md-3 ml-sm-0 pt-md-0 pt-sm-1 xsubtitle-buscar">(Main table)</p>
                </div>
                <a href="#" id="desplegar-busqueda1" data-toggle="collapse"><i
                    class="fa fa-chevron-up"></i></a>
            </div>

            <div>
                <table :id="'list' + tableName">
                    <tr>
                        <td></td>
                    </tr>
                </table>
                <div :id="'pager' + tableName"></div>
            </div>

            <options-modal :name="'optionsModal'"></options-modal>
        </div>
    </div>
</template>

<script>
import {defineComponent, onMounted} from "vue";
import OptionsModal from "@/components/modal/optionsModal.vue";
import config from "@/modules/locations/config/config";
import {useAuth} from "@/modules/auth/use/useAuth";

export default defineComponent({
    components: {OptionsModal},
    props: ['tableName'],
    setup: function (props) {
        const {user} = useAuth();

        onMounted(() => {
            const body = window.$('body');
            const list = body.find("#list" + props.tableName);
            const pager = body.find("#pager" + props.tableName);

            list.jqGrid({
                ...config,
                pager,
                postData: {
                    filters: [{field: 'companyId', value: user?.value?.company.id}]
                }
            });
        })
    }
})
</script>

<style scoped>

</style>
