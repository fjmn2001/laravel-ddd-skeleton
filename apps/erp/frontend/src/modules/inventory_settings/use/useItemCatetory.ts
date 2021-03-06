import {ref, Ref} from "vue";
import {ItemCategory} from "@/modules/inventory_settings/types/ItemCategory";
import {v4 as uuidv4} from "uuid";
import {api} from "@/modules/inventory_settings/services/item_categories/api";

const itemCategory: Ref<ItemCategory> = ref({
    id: uuidv4(),
    name: '',
    description: '',
    state: 'active',
    companyId: ''
});

export function useItemCategory() {
    async function create() {
        await api.createItemCategory()
    }

    function reset() {
        itemCategory.value = {
            id: uuidv4(),
            name: '',
            description: '',
            state: 'active',
            companyId: ''
        };
    }

    return {
        itemCategory,
        create,
        reset
    }
}
