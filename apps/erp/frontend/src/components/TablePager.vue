<template>
    <div class="justify-content-center mt-0 pt-0 row">
        <div
            class="align-items-center col-md-6 d-flex justify-content-center offset-md-3 pb-3 pt-3 pagination">
            <button class="btn btn-cicle" :class="{'btn-default': currentPage === 1}" :disabled="currentPage === 1"
                    @click="first">
                <img src="@/assets/images/icons/two-arrow-left.svg">
            </button>
            <button class="btn btn-cicle" :class="{'btn-default': currentPage === 1}" :disabled="currentPage === 1"
                    @click="prev">
                <img src="@/assets/images/icons/one-arrow-left.svg"
                     style="width: 0.4rem;">
            </button>
            <p class="p-pag">
                Página <input type="text" class="inp-pag" v-model="currentPage">&nbsp;de {{ lastPage() }}
            </p>

            <button class="btn btn-cicle" :class="{'btn-default': currentPage === lastPage()}"
                    :disabled="currentPage === lastPage()" @click="next">
                <img src="@/assets/images/icons/one-arrow-right.svg" style="width: 0.4rem;">
            </button>
            <button class="btn btn-cicle" :class="{'btn-default': currentPage === lastPage()}"
                    :disabled="currentPage === lastPage()" @click="last">
                <img src="@/assets/images/icons/two-arrow-right.svg">
            </button>
            <select class="inp-pag sel-pag" v-model="rowsByPage">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="align-items-center col-md-3 d-flex justify-content-end pb-3 pt-3">
            <p class="mr-4 p-pag">Mostrando {{ firstRow() }} - {{ lastRow() }} de {{ totalRows }}</p>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent, ref, Ref, watch} from "vue";

export default defineComponent({
    props: {
        totalRows: {
            type: Number,
            required: true
        }
    },
    setup(props) {
        const currentPage: Ref<number> = ref(1);
        const rowsByPage: Ref<number> = ref(10);

        function lastPage(): number {
            const trunc = Math.trunc(props.totalRows / rowsByPage.value);

            return (props.totalRows % rowsByPage.value) > 0 ? trunc + 1 : trunc;
        }

        function next() {
            if (currentPage.value < lastPage()) {
                currentPage.value += 1;
            }
        }

        function prev() {
            if (currentPage.value > 1) {
                currentPage.value -= 1;
            }
        }

        function first() {
            currentPage.value = 1;
        }

        function last() {
            currentPage.value = lastPage();
        }

        function firstRow() {
            return (rowsByPage.value * (currentPage.value - 1)) + 1;
        }

        function lastRow() {
            const lastRow = rowsByPage.value * (currentPage.value);

            return lastRow > props.totalRows ? props.totalRows : lastRow;
        }

        watch(() => currentPage.value, (val) => {
            if (val < 1 || val > lastPage()) {
                currentPage.value = 1;
            }
        })

        return {
            currentPage,
            rowsByPage,
            lastPage,
            next,
            prev,
            first,
            last,
            firstRow,
            lastRow
        }
    }
})
</script>

<style scoped>

</style>
