import {ref, Ref} from "vue";
import {v4 as uuidv4} from 'uuid';
import {Company} from "@/modules/companies/types/Company";
import {api} from "@/modules/companies/services/api";

export function useCompany() {
    const company: Ref<Company> = ref({
        id: uuidv4(),
        name: '',
        state: 'active',
        address: '',
        phone: ''
    })

    async function create() {
        await api.createCompany()
    }

    return {
        company,
        create
    }
}
