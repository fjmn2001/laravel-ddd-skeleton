import {Filter} from "@/types/Filter";
import {Ref, ref} from "vue";
import {api} from "@/modules/locations/service/api";
import {Location} from "@/modules/locations/type/Location";
import {useAuth} from "@/modules/auth/use/useAuth";

const filters: Ref<Filter[]> = ref([]);
const locations: Ref<Location[]> = ref([]);
const count: Ref<number> = ref(0);
const orderBy: Ref<string> = ref('created_at');
const order: Ref<string> = ref('desc');
const limit: Ref<number> = ref(10);
const offset: Ref<number> = ref(0);
const loading: Ref<boolean> = ref(false)
const loaded = ref(false)
const {user} = useAuth();

async function getLocations(pFilters: Array<Filter>) {
    loading.value = true
    filters.value = pFilters
    const filterCompanyId = filters.value.find((f) => f.field === 'companyId')

    if (!filterCompanyId) {
        filters.value.push({field: 'companyId', value: user?.value?.company.id})
    } else {
        const index = filters.value.indexOf(filterCompanyId)
        filters.value[index]['value'] = user?.value?.company.id
    }

    locations.value = await api.getLocations(filters.value, orderBy.value, order.value, limit.value, offset.value)
    loading.value = false
    loaded.value = true
    count.value = await api.getLocationsCount(filters.value)
}

async function setFromPager({pLimit, pOffset}: { pLimit: number, pOffset: number }) {
    limit.value = pLimit;
    offset.value = pOffset;
    await getLocations(filters.value)
}

export function useLocations() {
    function hasData() {
        return locations.value.length > 0 && loaded;
    }

    function showRows() {
        return hasData() && !loading.value
    }

    function showNoResults() {
        return !hasData() && !loading.value
    }

    return {
        locations,
        count,
        getLocations,
        hasData,
        showRows,
        showNoResults,
        setFromPager,
        loading
    };
}
