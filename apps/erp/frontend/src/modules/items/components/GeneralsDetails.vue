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
                        <input type="text" name="code" required="" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Nombre *</label>
                        <input type="text" required="" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Referencia</label>
                        <input type="text" class="form-control inp-filter">
                    </div>
                </div>

                <div class="mt-3 pl-3 pr-3 row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label>Tipo de item *</label>
                        <select2 name="type" :config="{}" :attr="{}">
                            <option value="">Select</option>
                            <option value="inventoried">Inventoried</option>
                            <option value="inventoried_serial">Inventoried with serial</option>
                            <option value="not_inventoried">Not inventoried</option>
                            <option value="service">Service</option>
                        </select2>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label>Categoría *</label>
                        <select2 name="categoryId" :config="{}" :attr="{}">
                            <option value="">Select</option>
                            <option :value="category.id" v-for="category in catalogs.categories"
                                    v-html="category.title" :key="category.id"></option>
                        </select2>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label>Estado *</label>
                        <select2 name="state" :config="{}" :attr="{}">
                            <option value="">Select</option>
                        </select2>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script lang="ts">
import {defineComponent, ref, onMounted, watch} from 'vue'
import {useCompany} from "@/modules/items/use/useCompany";
import {useCatalog} from "@/modules/items/use/useCatalog";

export default defineComponent({
    setup() {
        const {company} = useCompany();
        const {catalogs} = useCatalog();

        const name = ref('')
        const state = ref('active')
        const address = ref('')
        const phone = ref('')

        onMounted(() => {
            name.value = company.value.name;
            state.value = company.value.state;
            address.value = company.value.address;
            phone.value = company.value.phone;
        })

        watch(() => name.value, val => company.value.name = val)
        watch(() => state.value, val => company.value.state = val)
        watch(() => address.value, val => company.value.address = val)
        watch(() => phone.value, val => company.value.phone = val)

        return {
            name,
            state,
            address,
            phone,
            catalogs
        }
    }
});
</script>

<style scoped>

</style>
