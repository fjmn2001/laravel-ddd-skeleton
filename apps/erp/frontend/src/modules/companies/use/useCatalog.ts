import {ref, Ref} from "vue";
import {Catalog} from "@/modules/companies/types/Catalog";
import {api} from "@/modules/companies/services/api";

const catalogs: Ref<Catalog | null> = ref(null);

export function useCatalog() {
    async function getCatalog() {
        if (null === catalogs.value) {
            catalogs.value = await api.getCatalog()
        }
    }

    return {
        catalogs,
        getCatalog
    }
}
