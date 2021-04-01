import {ref, Ref} from "vue";
import {v4 as uuidv4} from "uuid";
import {ClientType} from "@/modules/sales_settings/types/ClientType";
import {api} from "@/modules/sales_settings/services/client_type/api";

const clientType: Ref<ClientType> = ref({
    id: uuidv4(),
    name: '',
    description: '',
    state: '',
    companyId: ''
});

export function useClientType() {

    async function create() {
        await api.createClientType()
    }

    return {
        clientType,

        create,
    }
}
