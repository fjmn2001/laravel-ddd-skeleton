import {ref, Ref} from "vue";
import {Company} from "@/modules/companies/types/Company";
import {api} from "@/modules/companies/services/api";

const companies: Ref<Company[]> = ref([]);
const loading = ref(false)

export function useCompanies() {
    const loaded = ref(false)

    async function getCompanies() {
        loading.value = true;

        companies.value = await api.getCompanies()

        loaded.value = true;
        loading.value = false;
    }

    function hasData() {
        return companies.value.length > 0 && loaded;
    }

    return {
        companies,
        hasData,
        loading,
        getCompanies
    }
}
