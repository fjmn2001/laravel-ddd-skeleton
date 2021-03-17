import {ref, Ref} from "vue";
import {Item} from "@/modules/items/types/Item";
import {api} from "@/modules/items/services/api";

const items: Ref<Item[]> = ref([]);
const itemsCount: Ref<number> = ref(0);
const loading = ref(false)

export function useItems() {
    const loaded = ref(false)

    async function getItems() {
        loading.value = true;

        items.value = await api.getItems()
        itemsCount.value = await api.getItemsCount()

        loaded.value = true;
        loading.value = false;
    }

    function hasData() {
        return items.value.length > 0 && loaded;
    }

    return {
        items,
        itemsCount,
        loading,
        hasData,
        getItems
    }
}
