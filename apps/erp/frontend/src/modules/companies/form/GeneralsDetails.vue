<template>
    <div class="d-datos-principal ml-n3 mr-n3">
        <div class="pb-4">
            <div class="align-items-center d-flex justify-content-between pt-sm-3 row">
                <div class="d-flex pl-md-3">
                    <h4 class="ml-5 ml-md-4 pb-md-0" style="padding-left: 12px;">Detalles de la
                        empresa</h4>
                </div>
            </div>
            <div class="des01 pb-2 pl-4 pr-4">
                <div class="mt-3 pl-3 pr-3 row">
                    <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
                        <img src="@/assets/images/company.jpg"
                             class="img-fluid img-thumbnail logo-empresa">
                    </div>
                    <div class="col-lg-9 col-md-6 col-sm-12 pt-4">
                        <label>
                            <label>Nombre de la empresa</label>
                        </label>
                        <input type="text" name="name" required="" class="form-control inp-filter">
                        <div class="mt-3 row">
                            <div class="col-lg-6 col-md-12">
                                <label>Tipo de empresa</label>
                                <input type="text" required="" class="form-control inp-filter">
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label>Estado</label>
                                <select required="" class="form-control inp-filter">
                                    <option value=""></option>
                                    <option value="1">option1</option>
                                    <option value="3">option2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 pl-3 pr-3 row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Dirección</label>
                        <input type="text" required="" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Teléfono</label>
                        <input type="text" required="" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Unidad de peso</label>
                        <select class="form-control inp-filter">
                            <option value=""></option>
                            <option value="1">option1</option>
                            <option value="2">option2</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Retiene impuestos</label>
                        <select class="form-control inp-filter">
                            <option value=""></option>
                            <option value="1">option1</option>
                            <option value="2">option2</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3 pl-3 pr-3 row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Código patronal</label>
                        <input type="text" required="" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label>Permitir crear facturas en periodos cerrados: </label>
                        <input type="text" required="" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Referencia&nbsp;</label>
                        <input type="text" required="" class="form-control inp-filter">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Details"
}
</script>

<style scoped>

</style>
