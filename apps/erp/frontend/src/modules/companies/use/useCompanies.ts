import {onMounted, ref, Ref} from "vue";
import {Company} from "@/modules/companies/types/Company";
import {api} from "@/modules/companies/services/api";

export function useCompanies() {
    const companies: Ref<Company[]> = ref([]);

    onMounted(async () => {
        //await store.dispatch('companies/companySearcher');
        //loaded.value = true;
        companies.value = await api.getCompanies()
    })

    return {
        companies
    }
}
