import {Filter} from "@/types/Filter";
import {Ref, ref} from "vue";

const loading: Ref<boolean> = ref(false)

export function useItems() {
    async function getItems(filters: Array<Filter>) {
        loading.value = true
        await console.log('getItems', filters)
        loading.value = false
    }

    return {
        getItems,
        loading
    };
}
