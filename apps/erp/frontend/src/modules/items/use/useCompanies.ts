import {ref, Ref} from "vue";
import {Company} from "@/modules/items/types/Company";
import {api} from "@/modules/items/services/api";

const items: Ref<Company[]> = ref([]);
const loading = ref(false)

export function useCompanies() {
    const loaded = ref(false)

    async function getCompanies() {
        loading.value = true;

        items.value = await api.getCompanies()

        loaded.value = true;
        loading.value = false;
    }

    function hasData() {
        return items.value.length > 0 && loaded;
    }

    return {
        items,
        hasData,
        loading,
        getCompanies
    }
}
