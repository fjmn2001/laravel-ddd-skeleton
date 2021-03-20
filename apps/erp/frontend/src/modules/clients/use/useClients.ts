import {ref, Ref} from "vue";
import {Client} from "@/modules/clients/types/Client";
import {api} from "@/modules/clients/services/api";

const clients: Ref<Client[]> = ref([]);
const loading = ref(false);

export function useClients() {
    const loaded = ref(false)

    async function getClients() {
        loading.value = true;

        clients.value = await api.getClients()

        loaded.value = true;
        loading.value = false;
    }

    function hasData() {
        return clients.value.length > 0 && loaded;
    }

    return {
        clients,
        hasData,
        loading,
        getClients
    }

}
