<template>
    <div>
        <div class="xcontainer">
            <div class="align-items-center d-flex div-title-card justify-content-between row">
                <div class="align-items-baseline d-sm-flex flex-md-row flex-sm-column">
                    <h5 class="xtitle-buscar">Datos de la ubicación</h5>
                </div>
                <a href="#des01" id="desplegar-busqueda" data-toggle="collapse"><i class="fa fa-chevron-down"></i></a>
            </div>
            <div id="des01" class="des01 m-3 pb-3">
                <div class="mt-3 pl-3 pr-3 row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Código *</label>
                        <input type="text" name="code" required="" v-model="code" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Nombre *</label>
                        <input type="text" name="name" required="" v-model="name" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Contacto principal *</label>
                        <input type="text" name="mainContact" required="" v-model="mainContact"
                               class="form-control inp-filter">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Código de barra *</label>
                        <input type="text" name="barcode" required="" v-model="barcode" class="form-control inp-filter">
                    </div>
                </div>
                <div class="mt-3 pl-3 pr-3 row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Dirección *</label>
                        <input type="text" name="address" required="" v-model="address" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label>Estado del ítem *</label>
                        <select2 name="itemState" required="" v-model="itemState" :config="{}" :attr="{}">
                            <option value="">Select</option>
                            <option :value="o.id" v-for="o in catalogs.itemStates" v-html="o.title"
                                    :key="o.id"></option>
                        </select2>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label>Estado *</label>
                        <select2 name="state" required="" v-model="state" :config="{}" :attr="{}">
                            <option value="">Select</option>
                            <option :value="o.id" v-for="o in catalogs.states" v-html="o.title" :key="o.id"></option>
                        </select2>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, ref} from "vue";

export default defineComponent({
    props: ['catalogs'],
    setup(props) {
        const code = ref('')
        const name = ref('')
        const mainContact = ref('')
        const barcode = ref('')
        const address = ref('')
        const itemState = ref('')
        const state = ref('')

        onMounted(() => console.log(props.catalogs))

        return {
            code,
            name,
            mainContact,
            barcode,
            address,
            itemState,
            state
        }
    }
})
</script>

<style scoped>

</style>
