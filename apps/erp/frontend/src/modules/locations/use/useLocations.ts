import {Filter} from "@/types/Filter";
import {Ref, ref} from "vue";

const loading: Ref<boolean> = ref(false)

export function useLocations() {
    async function getLocations(filters: Array<Filter>) {
        loading.value = true
        await console.log('getLocations', filters)
        loading.value = false
    }

    return {
        getLocations,
        loading
    };
}
