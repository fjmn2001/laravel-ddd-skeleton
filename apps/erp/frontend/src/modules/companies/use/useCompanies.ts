import {onMounted, ref, Ref} from "vue";
import {Company} from "@/modules/companies/types/Company";
import {api} from "@/modules/companies/services/api";

export function useCompanies() {
    const companies: Ref<Company[]> = ref([]);
    const loaded = ref(false)
    const loading = ref(false)

    onMounted(async () => {
        loading.value = true;

        companies.value = await api.getCompanies()

        loaded.value = true;
        loading.value = false;
    })

    function hasData() {
        return companies.value.length > 0 && loaded;
    }

    return {
        companies,
        hasData,
        loading
    }
}
