import {ref, Ref} from "vue";
import {v4 as uuidv4} from 'uuid';
import {Item} from "@/modules/items/types/Item";
import {api} from "@/modules/items/services/api";
import {useAuth} from "@/modules/auth/use/useAuth";

const {user} = useAuth();

const item: Ref<Item> = ref({
    id: uuidv4(),
    code: '',
    name: '',
    reference: '',
    type: '',
    categoryId: '',
    state: 'active',
    averageCost: 0,
    companyId: user.value ? user.value.company.id : '',
})

export function useItem() {
    async function create() {
        await api.createItem()
    }

    async function update() {
        await api.updateItem()
    }

    async function find(id: string) {
        item.value = await api.findItem(id)
    }

    async function reset() {
        item.value = {
            id: uuidv4(),
            code: '',
            name: '',
            reference: '',
            type: '',
            categoryId: '',
            state: 'active',
            averageCost: 0,
            companyId: user.value ? user.value.company.id : '',
        };
    }

    return {
        item,
        create,
        update,
        find,
        reset
    }
}
