<template>
    <div>
        <div class="xcontainer">
            <div class="align-items-center d-flex div-title-card justify-content-between row">
                <div class="align-items-baseline d-sm-flex flex-md-row flex-sm-column">
                    <h5 class="xtitle-buscar">Item details</h5>
                    <p class="ml-md-3 ml-sm-0 pt-md-0 pt-sm-1 xsubtitle-buscar">(Form)</p>
                </div>
                <a href="#des01" id="desplegar-busqueda" data-toggle="collapse"><i class="fa fa-chevron-down"></i></a>
            </div>
            <div id="des01" class="des01 m-3 pb-3">
                <div class="mt-3 pl-3 pr-3 row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Número de ítem *</label>
                        <input type="text" name="code" required="" v-model="code" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-9 col-md-12 col-sm-12">
                        <label>Nombre de ítem *</label>
                        <input type="text" required="" v-model="name" class="form-control inp-filter">
                    </div>
                </div>

                <div class="mt-3 pl-3 pr-3 row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Referencia</label>
                        <input type="text" v-model="reference" class="form-control inp-filter">
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label>Tipo de ítem *</label>
                        <select2 name="type" required="" v-model="type" :config="{}" :attr="{}">
                            <option value="">Select</option>
                            <option value="inventoried">Inventoried</option>
                            <option value="inventoried_serial">Inventoried with serial</option>
                            <option value="not_inventoried">Not inventoried</option>
                            <option value="service">Service</option>
                        </select2>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label>Categoría *</label>
                        <select2 name="categoryId" required="" v-model="categoryId" :config="{}" :attr="{}">
                            <option value="">Select</option>
                            <option :value="category.id" v-for="category in catalogs.categories"
                                    v-html="category.title" :key="category.id"></option>
                        </select2>
                    </div>
                </div>

                <div class="mt-3 pl-3 pr-3 row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label>Estado *</label>
                        <select2 name="state" required="" v-model="state" :config="{}" :attr="{}">
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select2>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script lang="ts">
import {defineComponent, ref, onMounted, watch} from 'vue'
import {useItem} from "@/modules/items/use/useItem";
import {useCatalog} from "@/modules/items/use/useCatalog";

export default defineComponent({
    setup() {
        const {item} = useItem();
        const {catalogs} = useCatalog();

        const code = ref('')
        const name = ref('')
        const reference = ref('')
        const type = ref('')
        const categoryId = ref('')
        const state = ref('active')

        onMounted(() => {
            code.value = item.value.code;
            name.value = item.value.name;
            reference.value = item.value.reference;
            type.value = item.value.type;
            categoryId.value = item.value.categoryId;
            state.value = item.value.state;
        })

        watch(() => code.value, val => item.value.code = val)
        watch(() => name.value, val => item.value.name = val)
        watch(() => reference.value, val => item.value.reference = val)
        watch(() => type.value, val => item.value.type = val)
        watch(() => categoryId.value, val => item.value.categoryId = val)
        watch(() => state.value, val => item.value.state = val)

        return {
            code,
            name,
            reference,
            type,
            categoryId,
            state,
            catalogs
        }
    }
});
</script>

<style scoped>

</style>
