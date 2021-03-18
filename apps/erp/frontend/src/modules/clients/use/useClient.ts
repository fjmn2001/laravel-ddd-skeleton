import {ref, Ref} from "vue";
import {v4 as uuidv4} from 'uuid';
import {Client} from "@/modules/clients/types/Client";
import {api} from "@/modules/clients/services/api";

const client: Ref<Client> = ref({
    id: uuidv4(),
    name: '',
    lastname: 'active',
    dni: '',
    dniType: '',
    clientType: '',
    clientCategory: '',
    frequentClientNumber: '',
    state: '',
    phones: [{
        id: uuidv4(),
        number: '',
        numberType: '',
    }],
    emails: [{
        id: uuidv4(),
        email: '',
        emailType: '',
    }],
});

export function useClient() {
    async function create() {
        await api.createClient()
    }

    async function update() {
        await api.updateClient()
    }

    async function find(id: string) {
        client.value = await api.findClient(id)
    }

    async function reset() {
        client.value = {
            id: uuidv4(),
            name: '',
            lastname: 'lastname',
            dni: 'dni',
            dniType: '',
            clientType: '',
            clientCategory: '',
            frequentClientNumber: '',
            state: 'active',
            phones: [{
                id: uuidv4(),
                number: '',
                numberType: '',
            }],
            emails: [{
                id: uuidv4(),
                email: '',
                emailType: '',
            }],
        };
    }

    return {
        client: client,
        create,
        update,
        find,
        reset
    }
}
