import {ref, Ref} from "vue";

export function useFilters() {
    const filters: Ref<string[]> = ref([]);

    function setFilters(newFilters: string[]) {
        filters.value = newFilters;
    }

    return {
        filters,
        setFilters
    }
}
