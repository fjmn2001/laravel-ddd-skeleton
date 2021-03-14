import {Client} from "@/modules/clients/types/Client";
import axios from "axios";
// import {useFilters} from "@/modules/shared/use/useFilters";
import {useFilters} from "@/modules/clients/use/useFilters";
import {useClient} from "@/modules/clients/use/useClient";

export const api = {
    async getClients(): Promise<Client[]> {
        const {filters, orderBy, order, limit, offset} = useFilters();
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/client', {
            params: {
                filters: filters.value,
                orderBy: orderBy.value,
                order: order.value,
                limit: limit.value,
                offset: offset.value
            }
        });
        return new Promise(resolve => {
            resolve(response.data);
        });
    },


    async createClient(): Promise<Client> {
        const {client} = useClient();
        const response = await axios.post(process.env.VUE_APP_ERP_URL + '/api/client', {
            id: client.value.id,
            name: client.value.name,
            lastname: client.value.lastname,
            dni: client.value.dni,
            dniType: client.value.dniType,
            clientType: client.value.clientType,
            clientCategory: client.value.clientCategory,
            frequentClientNumber: client.value.frequentClientNumber,
            state: client.value.state,
            phones: client.value.phones,
            emails: client.value.emails,
        });
        return new Promise(resolve => {
            resolve(response.data);
        });
    },


    async updateClient(): Promise<Client> {
        const {client} = useClient();

        const response = await axios.put(process.env.VUE_APP_ERP_URL + '/api/client/' + client.value.id, {
            name: client.value.name,
            lastname: client.value.lastname,
            dni: client.value.dni,
            dniType: client.value.dniType,
            clientType: client.value.clientType,
            clientCategory: client.value.clientCategory,
            frequentClientNumber: client.value.frequentClientNumber,
            state: client.value.state,
            phones: client.value.phones,
            emails: client.value.emails,
            logo: 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fvuejs.org%2F&psig=AOvVaw2iwaicA5-fgsHJgOFWwde7&ust=1613311099724000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCPik6qyC5-4CFQAAAAAdAAAAABAD'
        });

        return new Promise(resolve => {
            resolve(response.data);
        });
    },

    async findClient(id: string): Promise<Client> {
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/client/' + id);
        return new Promise(resolve => {
            resolve(response.data);
        });
    },
}
