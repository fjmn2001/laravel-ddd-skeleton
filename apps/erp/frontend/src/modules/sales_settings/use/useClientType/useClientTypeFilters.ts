import {ref, Ref} from "vue";
import {Filter} from "@/types/Filter";

const filters: Ref<Filter[]> = ref([]);
const orderBy: Ref<string> = ref('created_at');
const order: Ref<string> = ref('desc');
const limit: Ref<number> = ref(10);
const offset: Ref<number> = ref(0);

export function useClientTypeFilters() {
    function setFilters(newFilters: Filter[]) {
        filters.value = newFilters;
    }

    function setFromPager({pLimit, pOffset}: { pLimit: number, pOffset: number }) {
        limit.value = pLimit;
        offset.value = pOffset;
    }

    return {
        filters,
        orderBy,
        order,
        limit,
        offset,
        setFilters,
        setFromPager
    }
}
