import {ref, Ref} from "vue";
import {v4 as uuidv4} from 'uuid';
import {Client} from "@/modules/clients/types/Client";
import {api} from "@/modules/clients/services/api";


const ClientePhones = {
    id: uuidv4(),
    number: '',
    numberType: '',
}
const ClienteEmails = {
    id: uuidv4(),
    email: '',
    emailType: '',
}

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
    phones: [ClientePhones],
    emails: [ClienteEmails],
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

    function addEmail() {
        return {
            id: uuidv4(),
            email: '',
            emailType: '',
        }
    }

    function addPhone() {
        return {
            id: uuidv4(),
            number: '',
            numberType: '',
        }
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
        ClienteEmails,
        ClientePhones,
        addEmail,
        addPhone,
        create,
        update,
        find,
        reset
    }
}
