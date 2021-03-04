<template>
    <div class="justify-content-center mt-0 pt-0 row">
        <div
            class="align-items-center col-md-6 d-flex justify-content-center offset-md-3 pb-3 pt-3 pagination">
            <a class="btn btn-cicle"><img src="@/assets/images/icons/two-arrow-left.svg"></a>
            <a class="btn btn-cicle"><img src="@/assets/images/icons/one-arrow-left.svg"
                                          style="width: 0.4rem;"></a>
            <p class="p-pag">Página <input type="text" value="1" class="inp-pag">&nbsp;de 6</p>
            <a class="btn btn-cicle"><img src="@/assets/images/icons/one-arrow-right.svg"
                                          style="width: 0.4rem;"></a>
            <a class="btn btn-cicle"><img src="@/assets/images/icons/two-arrow-right.svg"></a>
            <select class="inp-pag sel-pag">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="align-items-center col-md-3 d-flex justify-content-end pb-3 pt-3">
            <p class="mr-4 p-pag">Mostrando 1 - 10 de 20</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "TablePager"
}
</script>

<style scoped>

</style>
