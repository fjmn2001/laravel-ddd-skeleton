import {Client} from "@/modules/clients/types/Client";
import axios from "axios";
import {useFilters} from "@/modules/shared/use/useFilters";
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
}
