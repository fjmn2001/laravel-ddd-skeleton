<template>
    <div class="xcontainer">
        <div class="mt-3">
            <div class="align-items-center d-flex justify-content-between pl-sm-3 pr-sm-3 pt-sm-3 row">
                <div class="d-flex">
                    <h4 class="ml-5 ml-md-4 pb-md-0" style="padding-left: 14px;">Usuarios asignados al cliente</h4>
                </div>
            </div>
            <div class="des01 pb-4 pl-4 pr-4">
                <div class="mt-3 pl-3 pr-3 row">
                    <div class="col-lg-5 col-md-5 pt-md-0">
                        <label>Línea de negocio o Centro contable</label>
                        <input type="text" required="" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-5 col-md-4">
                        <label>Asignado a</label>
                        <div class="form-group mb-0">
                            <div class="input-group">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="align-items-md-end col-lg-2 col-md-2 d-md-flex">
                        <button type="button" class="btn btn-block btn-outline-secondary d-inline">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";

export default defineComponent({
    setup() {
        return [];
    }
})
</script>

<style scoped>

</style>
