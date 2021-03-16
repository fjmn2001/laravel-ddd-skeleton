import {ref, Ref} from "vue";
import {v4 as uuidv4} from 'uuid';
import {Company} from "@/modules/items/types/Company";
import {api} from "@/modules/items/services/api";

const company: Ref<Company> = ref({
    id: uuidv4(),
    name: '',
    state: 'active',
    address: '',
    phone: ''
})

export function useCompany() {
    async function create() {
        await api.createCompany()
    }

    async function update() {
        await api.updateCompany()
    }

    async function find(id: string) {
        company.value = await api.findCompany(id)
    }

    async function reset() {
        company.value = {
            id: uuidv4(),
            name: '',
            state: 'active',
            address: '',
            phone: ''
        };
    }

    return {
        company: company,
        create,
        update,
        find,
        reset
    }
}
