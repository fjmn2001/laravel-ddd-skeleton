import {Filter} from "@/types/Filter";
import {Ref, ref} from "vue";
import {api} from "@/modules/locations/service/api";
import {Location} from "@/modules/locations/type/Location";

const locations: Ref<Location[]> = ref([]);
const orderBy: Ref<string> = ref('created_at');
const order: Ref<string> = ref('desc');
const limit: Ref<number> = ref(10);
const offset: Ref<number> = ref(0);
const loading: Ref<boolean> = ref(false)

export function useLocations() {
    async function getLocations(filters: Array<Filter>) {
        loading.value = true
        locations.value = await api.getLocations(
            filters,
            orderBy.value,
            order.value,
            limit.value,
            offset.value
        )
        loading.value = false
    }

    return {
        getLocations,
        loading
    };
}
