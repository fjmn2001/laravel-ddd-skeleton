import {ref, Ref} from "vue";
import {ItemCategory} from "@/modules/inventory_settings/types/ItemCategory";
import {v4 as uuidv4} from "uuid";
import {useAuth} from "@/modules/auth/use/useAuth";

const {user} = useAuth();
const itemCategory: Ref<ItemCategory> = ref({
    id: uuidv4(),
    name: '',
    description: '',
    state: '',
    companyId: user.value ? user.value.company.id : ''
});

export function useItemCategory() {
    function reset() {
        itemCategory.value = {
            id: uuidv4(),
            name: '',
            description: '',
            state: '',
            companyId: user.value ? user.value.company.id : ''
        };
    }

    return {
        itemCategory,
        reset
    }
}
