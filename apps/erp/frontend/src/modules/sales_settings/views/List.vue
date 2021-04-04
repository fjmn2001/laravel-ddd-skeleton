<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <div class="container-fluid main-conta">
            <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>

            <div class="xcontainer">
                <div class="row" id="config01">
                    <div class="config-div01 pl-5">
                        <button type="button" id="menu-config-collapse" class="bnt-config btn ml-md-2 ml-sm-3 mt-sm-3">
                            <i class="icon-settings" style="color: #576984;"></i>
                            <span>Menu de configuraciones</span>
                        </button>
                        <div id="menu-config">
                            <ul class="list-unstyled components">
                                <li :class="{'active': option.name === optionSelected}" v-for="option in options"
                                    :key="option.name" @click.prevent="selectOption(option.name)">
                                    <a href="#" v-html="option.title"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <client-categories v-if="optionSelected === 'client-categories' && user"></client-categories>
                    <client-types v-if="optionSelected === 'client-types' && user"></client-types>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent, Ref, ref} from 'vue'
import Breadcrums from '@/components/Breadcrums.vue';
import {useCore} from "@/modules/shared/use/useCore";
import {useAuth} from "@/modules/auth/use/useAuth";

import ClientTypes from "@/modules/sales_settings/components/ClientTypes.vue";
import ClientCategories from "@/modules/sales_settings/components/ClientCategories.vue";

export default defineComponent({
    components: {Breadcrums, ClientTypes, ClientCategories},
    setup() {
        const {ERP_URL} = useCore();
        const breadcrumbUrl: string = ERP_URL + '/api/client/breadcrumbs'
        const options = ref([
            {name: 'client-categories', title: 'Categorías de clientes'},
            {name: 'client-types', title: 'Tipos de clientes'}
        ])
        const optionSelected: Ref<string | null> = ref('client-categories')
        const {user} = useAuth();

        function selectOption(name: string) {
            optionSelected.value = name;
        }

        return {
            breadcrumbUrl,
            options,
            optionSelected,
            user,
            selectOption
        }
    }
})
</script>

<style scoped>

</style>
