<template>
    <div class="xcontainer">
        <div class="mt-3">
            <div class="align-items-center d-flex justify-content-between pl-sm-3 pr-sm-3 pt-sm-3 row">
                <div class="d-flex">
                    <h4 class="ml-5 ml-md-4 pb-md-0" style="padding-left: 14px;">Información de contacto</h4>
                </div>
            </div>

            <div class="des01 pb-4 pl-4 pr-4">
                <div class="mt-3 pl-3 pr-3 row">

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-5">
                                <label>Teléfono *</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control inp-filter">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label>Uso del teléfono</label>
                                <select class="form-control inp-filter">
                                    <option value=""></option>
                                    <option value="trabajo">Trabajo</option>
                                    <option value="movil">Móvil</option>
                                    <option value="fax">Fax</option>
                                    <option value="residencial">Residencial</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                            <div class="col-md-2 pad-l29">
                                <button type="button" class="btn btn-block btn-outline-secondary d-inline">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-5">
                                <label>Correo electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i>@</i></span>
                                    <input type="text" class="form-control inp-filter">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label>Uso del correo</label>
                                <select class="form-control inp-filter">
                                    <option value=""></option>
                                    <option value="trabajo">Trabajo</option>
                                    <option value="movil">Personal</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                            <div class="col-md-2 pad-l29">
                                <button type="button" class="btn btn-block btn-outline-secondary d-inline">+</button>
                            </div>
                        </div>
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
